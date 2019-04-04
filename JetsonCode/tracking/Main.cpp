#include "opencv2/opencv.hpp"
#include "opencv2/core/core.hpp"
#include <cscore.h>
#include <iostream>
#include <chrono>
#include <cstdio>
#include <thread>
#include "ntcore.h"
#include "networktables/NetworkTable.h"
#include <fstream>

using namespace std;
using namespace cv;
//using namespace cs;


int hue_min = 0, hue_max = 180, sat_min = 0, sat_max = 25, val_min = 245, val_max = 255;

int min_area = 200, max_area = 1000000;

float aspectRatio = 329.0 / 142.0;
float screenWidthPx = 640;
float tapeToTape = 12.25;
float zeroDistanceIn = 34.5;
float zeroBoxWidthPx = 274;

float offset = 0;
float offsetOffset = 0;

float boxWidthPx = 0, boxHeightPx = 0;

float perpDistance = 0, horizDistance = 0, rawDistance = 0;

float pxPerInch = 0;
float screenWidthIn = 0; 

float zeroPxPerInch = zeroBoxWidthPx / tapeToTape;
float zeroScreenWidthIn = screenWidthPx/zeroPxPerInch;

float distanceRatio = zeroDistanceIn / zeroScreenWidthIn;

float adjustedWidthPx = aspectRatio * boxHeightPx;

float angle = 3.14/2;

/*
Find the pxPerInch for the view then get the total width of the screen
*/

int main(int argc, char *argv[]) {
	
	
	//cs::HttpCamera camera{"httpcam", "http://localhost:8081/?action=stream"};
  /*
  camera.SetVideoMode(cs::VideoMode::kMJPEG, 320, 240, 30);
  cs::CvSink cvsink{"cvsink"};
  cvsink.SetSource(camera);
  cs::CvSource cvsource{"cvsource", cs::VideoMode::kMJPEG, 320, 240, 30};
  cs::MjpegServer cvMjpegServer{"cvhttpserver", 8083};
  cvMjpegServer.SetSource(cvsource);

  cv::Mat test;
  cv::Mat flip;
  for (;;) {
    uint64_t time = cvsink.GrabFrame(test);
    if (time == 0) {
      std::cout << "error: " << cvsink.GetError() << std::endl;
      continue;
    }
    std::cout << "got frame at time " << time << " size " << test.size()
              << std::endl;
    cv::flip(test, flip, 0);
    cvsource.PutFrame(flip);
*/

	
	NetworkTable::SetClientMode();
	NetworkTable::SetTeam(7556);
	
	auto rawValues = NetworkTable::GetTable("rawValues");
	/*
	namedWindow("bars", 1);

	createTrackbar("Hue_Min", "bars", &hue_min, 180);
	createTrackbar("Hue_Max", "bars", &hue_max, 180);
	createTrackbar("Sat_Min", "bars", &sat_min, 255);
	createTrackbar("Sat_Max", "bars", &sat_max, 255);
	createTrackbar("Val_Min", "bars", &val_min, 255);
	createTrackbar("Val_Max", "bars", &val_max, 255);

	//Mat imgRgb = imread("color.jpg");
*/
	VideoCapture cap(1);
	if (!cap.isOpened()) return -1;

	for (;;) {

		Mat imgRgb;
		cap >> imgRgb;

		Mat imgHsv;
		//cvtColor(imgRgb, imgHsv, CV_BGR2HSV);
		cvtColor(imgRgb, imgHsv, COLOR_BGR2HSV);

		Mat imgGrey;
		inRange(imgHsv, Scalar(hue_min, sat_min, val_min), Scalar(hue_max, sat_max, val_max), imgGrey);

		vector<Point> centers;
		vector<Rect> bounders;
		vector<vector<Point	> > contours;
		vector<Vec4i> hierarchy;

		findContours(imgGrey, contours, hierarchy, RETR_EXTERNAL, CHAIN_APPROX_SIMPLE);

		for (size_t i = 0; i < contours.size(); i++) {
			int area = contourArea(contours[i]);
			//cout << area;
			if (area < max_area && area > min_area) {
				bounders.push_back(boundingRect(contours[i]));
			}
		}

		vector<Rect> pair;
		
		
		float minError = 1000000000;

		for (size_t i = 0; i < bounders.size(); i++) {
			for (size_t j = 0; j < bounders.size(); j++) {				
				if (j != i) {
					float width1 = bounders[i].x+bounders[i].width;
					float width2 = bounders[j].x+bounders[j].width;
					float height1 = bounders[i].y+bounders[i].height;
					float height2 = bounders[j].y+bounders[j].height;
					float currError = abs(width1-width2)+abs(height1-height2)+abs(bounders[i].x-bounders[j].x)+abs(bounders[i].y-bounders[j].y);
					if (currError < minError) {
						pair.push_back(bounders[i]);
						pair.push_back(bounders[j]);
					}
				}
			}
		}
		
		
		if (pair.size() > 1) {

			centers.push_back(Point(pair[0].x + pair[0].width / 2, pair[0].y + pair[0].height / 2));
			centers.push_back(Point(pair[1].x + pair[1].width / 2, pair[1].y + pair[1].height / 2));

			boxWidthPx = abs(centers[0].x-centers[1].x);
			boxHeightPx = abs((pair[0].height+pair[1].height)/2);
			
			offset = (imgRgb.cols/2)-(centers[0].x + centers[1].x)/2-offsetOffset;
			
			adjustedWidthPx = boxHeightPx * aspectRatio;

			//cout << "w: " << boxWidthPx << " h: " << boxHeightPx << " asp: " << aspectRatio << " adj: " << adjustedWidthPx << endl;
			if (abs(boxWidthPx / adjustedWidthPx) < 1) {
				angle = asin(boxWidthPx / adjustedWidthPx);
			}
			else {
				angle = asin(1);
			}

			screenWidthIn = screenWidthPx / (boxWidthPx / tapeToTape);
			rawDistance = distanceRatio * screenWidthIn;
			perpDistance = rawDistance * sin(angle);
			horizDistance = rawDistance * cos(angle);

		} else {
			perpDistance = 0;
			horizDistance = 0;
			angle = 3.14/2;
			offset = 0;
		}

		Mat imgBox = imgRgb.clone();
		for (size_t i = 0; i < pair.size(); i++) {
			rectangle(imgBox, pair[i], Scalar(0, 0, 255), 2);
			//circle(imgBox, Point(bounders[i].x + bounders[i].width / 2, bounders[i].y + bounders[i].height / 2), 10, Scalar(0, 0, 255), 2);
		}

		if (centers.size() > 0) {
			line(imgBox, centers[0], centers[1], Scalar(0, 0, 255),2);
			//putText(imgBox, to_string(boxWidthPx), Point(centers[0].x + boxWidthPx / 2, centers[0].y-10), FONT_HERSHEY_PLAIN, 2, Scalar(0, 0, 2));
		}
		//cout << " w: " << boxWidthPx << " h: " << boxHeightPx << endl;
		//cout << perpDistance << endl;
		//cout << imgRgb.cols << endl;
		//cout << "angle " << angle * (180 / 3.1415) << " perp: " << perpDistance << " horiz: " << horizDistance << endl;
		cout << offset << endl;
		rawValues->PutNumber("angle", angle);
		rawValues->PutNumber("x", horizDistance);
		rawValues->PutNumber("y", perpDistance);
		rawValues->PutNumber("offset", offset);
		
		
		vector<uchar> buf;
		imencode(".jpg", imgBox, buf, vector<int>());
		
		string content(buf.begin(), buf.end());
		


		imshow("image", imgBox);
		//imshow("imgrey", imgGrey);
		if (waitKey(30) == 27) break;
	}

}

