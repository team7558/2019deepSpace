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
	#include "MJPEGWriter.h"

	using namespace std;
	using namespace cv;

	/*min and max HSV values for colour filtering - determined empirically with trackbars*/
	int hue_min = 55, hue_max = 83, sat_min = 186, sat_max = 255, val_min = 55,
	    val_max = 255;

	/*min and max areas to look for enclosed contours*/
	int min_area = 200, max_area = 10000;

	/*ratio of vision targets (widht/height) to look for closest matches*/
	float targetRatio = 12.0/5.0;

	/*the distance of the previously tracked target to the center of the screen for tracking*/
	float prevTargetCenter = 320;	

	/*returns height and width of RotatedRect object*/
	vector<float> getHW(RotatedRect rotatedRect){
		Point2f rect_points[4];
		rotatedRect.points(rect_points);
		float height = 0;
		float width = 0;
		for (size_t i = 0; i < 4; i++){
			for (size_t j = 0; j < 4; j++){
				if (i != j){
					float currHeight = abs(rect_points[i].y-rect_points[j].y); 					
					float currWidth = abs(rect_points[i].x-rect_points[j].x);					
					if (currHeight>height){	
						height = currHeight;
					}
					if (currWidth>width){	
						width = currWidth;
					}
				}
			}
		}
		vector<float> ret = {height, width};
		return ret;
	}

	/*returns angle of RotatedRect wrt vertical y axis*/
	float getAngle(RotatedRect rotatedRect) {
	    Point2f rect_points[4];
	    rotatedRect.points(rect_points);
	    Point2f edge1 = Vec2f(rect_points[1].x, rect_points[1].y) -
		            Vec2f(rect_points[0].x, rect_points[0].y);
	    Point2f edge2 = Vec2f(rect_points[2].x, rect_points[2].y) -
		            Vec2f(rect_points[1].x, rect_points[1].y);
	
	    Point2f usedEdge = edge1;
	    if (norm(edge2) > norm(edge1)) usedEdge = edge2;

	    Point2f reference = Vec2f(1, 0);

	    return 180.0f / CV_PI *
		   acos((reference.x * usedEdge.x + reference.y * usedEdge.y) /
		        (norm(reference) * norm(usedEdge)));
	}

	int getQuadrant(RotatedRect rotatedRect) {
	    float angle = getAngle(rotatedRect);
	    if (angle > 0 && angle < 90) {
		return 1;
	    } else if (angle >= 90 && angle < 180) {
		return 2;
	    }
	    return -1;
	}
	
	/*draws a rectangle and other info in given colour*/
	void drawRect(Mat mask, RotatedRect rotatedRect, Scalar colour) {
	    Point2f rect_points[4];
	    rotatedRect.points(rect_points);
	    for (size_t i = 0; i < 4; ++i) {
		//cout << rect_points[j] << endl;
		line(mask, rect_points[i], rect_points[(i + 1) % 4], colour,  2);
	    }

	    Point2f center = rotatedRect.center; // center

	    stringstream ss;
	    ss << getAngle(rotatedRect);
	    //ss << getQuadrant(rotatedRect);
	    //ss << getHW(rotatedRect)[0];
            circle(mask, center, 5, Scalar(0, 255, 0)); // draw center
	    putText(mask, ss.str(), center + Point2f(-25, 25), FONT_HERSHEY_COMPLEX_SMALL,
		    1, Scalar(255, 0, 255)); // print angle
	}


	int main(int argc, char * argv[]) {
	
		/*trackbars for adjusting HSV values, one time use*/
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
	
	/*connect network tables to roborio*/
	    NetworkTable::SetClientMode();
	    NetworkTable::SetTeam(7556);
	    auto rawValues = NetworkTable::GetTable("rawValues");

	/*start capturing video*/
	    VideoCapture cap(0);
	    if (!cap.isOpened()) return -1;

	/*start streaming live feed to port 7558*/
	    MJPEGWriter streamer(7558); 
	    Mat frame;
	    cap >> frame;
	    streamer.write(frame);
	    frame.release();
	    streamer.start();

	    for (;;) {
		Mat imgRgb;
		cap >> imgRgb;
		
		/*convert RGB to HSV for easy colour detection*/
		Mat imgHsv;
		// cvtColor(imgRgb, imgHsv, CV_BGR2HSV);
		cvtColor(imgRgb, imgHsv, COLOR_BGR2HSV);
		
		/*threshold HSV image based on min max HSV values to produce black/white image*/
		Mat imgGrey;
		inRange(imgHsv, Scalar(hue_min, sat_min, val_min),
		        Scalar(hue_max, sat_max, val_max), imgGrey);

		vector < vector < Point > > contours;
		vector < Vec4i > hierarchy;

		vector < RotatedRect > rotatedRects;
		
		/*find all closed contours on the black/white thresholded image*/
		findContours(imgGrey, contours, hierarchy, RETR_EXTERNAL,
		             CHAIN_APPROX_SIMPLE);

		Mat angledImg = imgRgb.clone();

		/*find all rotated rectangles from contours, filtering of which ones are targets is done later*/
		for (size_t i = 0; i < contours.size(); i++) {
		    int area = contourArea(contours[i]);
		    if (area < max_area && area > min_area) {
		        rotatedRects.push_back(minAreaRect(contours[i]));
		    }
		}

		vector < RotatedRect >	pairs; // the pair of rectangles that the robot will track

		/*find all pairs of rectangles that match the shape (both pointing inwards) using angles*/
		for (size_t i = 0; i < rotatedRects.size(); i++) {
			for (size_t j = 0; j < rotatedRects.size(); j++){
				if (i != j) {
					Point2f center1 = rotatedRects[i].center;
					Point2f center2 = rotatedRects[j].center;
					RotatedRect leftRect;
					RotatedRect rightRect; 
					if (center1.x < center2.x){
						leftRect = rotatedRects[i];
						rightRect = rotatedRects[j];
					} else {
						leftRect = rotatedRects[j];
						rightRect = rotatedRects[i];
					}
					if (getQuadrant(leftRect) == 1 && getQuadrant(rightRect) == 2) {						
						pairs.push_back(leftRect);
						pairs.push_back(rightRect);
					}
				}
			}
		}
		
		vector <RotatedRect> pair;

		float minError = 1000000;		
		float offset = -1;

		/*find the one pair that is closest to the desired aspect ratio, and that is closest to the previous pair*/
		for (size_t i = 0; i < pairs.size(); i+= 2){
			drawRect(angledImg, pairs[i], Scalar(255,0,0));
			drawRect(angledImg, pairs[i+1], Scalar(0,0,255));
			float width = abs(pairs[i].center.x-pairs[i+1].center.x);
			float targetWidth = targetRatio * getHW(pairs[i])[0];
			float currError = abs(width-targetWidth)+abs(prevTargetCenter-(pairs[i].center.x+width/2));
			if (currError < minError) {
				pair.clear();
				pair.push_back(pairs[i]);
				pair.push_back(pairs[i+1]);
				minError = currError;
				offset = imgRgb.cols/2-(pairs[i].center.x+width/2);			
			}
		}	

		if (pair.size() > 1){
			line(angledImg, pair[0].center, pair[1].center, Scalar(0,255,0), 2);
		} else {
			prevTargetCenter = imgRgb.cols/2;
		}

		rawValues->PutNumber("offset", offset);
		//cout << offset << endl;

		//imshow("angledBox", angledImg);

		streamer.write(angledImg);
		angledImg.release();
					
		if (waitKey(30) == 27) break;

	    }

	    streamer.stop();
	}
