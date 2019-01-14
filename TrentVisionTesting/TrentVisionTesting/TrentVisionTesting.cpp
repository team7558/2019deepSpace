// TrentVisionTesting.cpp : This file contains the 'main' function. Program execution begins and ends there.
//

#include "pch.h"
#include <opencv2/opencv.hpp>
#include <iostream>

using namespace std;
using namespace cv;

int hue_min = 64, hue_max = 94, sat_min = 157, sat_max = 255, val_min = 121, val_max = 223;

int min_area = 10000, max_area = 10000000;

int main() {

	//namedWindow("bars", 1);

	/*
	createTrackbar("Hue_Min", "bars", &hue_min, 180);
	createTrackbar("Hue_Max", "bars", &hue_max, 180);
	createTrackbar("Sat_Min", "bars", &sat_min, 255);
	createTrackbar("Sat_Max", "bars", &sat_max, 255);
	createTrackbar("Val_Min", "bars", &val_min, 255);
	createTrackbar("Val_Max", "bars", &val_max, 255);
	*/

	Mat imgRgb = imread("color.jpg");

	Mat imgHsv;
	cvtColor(imgRgb, imgHsv, COLOR_BGR2HSV);

	for (;;) {
		Mat imgGrey;
		inRange(imgHsv, Scalar(hue_min, sat_min, val_min), Scalar(hue_max, sat_max, val_max), imgGrey);

		Mat canny;
		Canny(imgGrey, canny, 10, 100);

		vector<vector<Point	>> contours;
		vector<Vec4i> hierarchy;

		findContours(canny, contours, hierarchy, RETR_EXTERNAL, CHAIN_APPROX_SIMPLE);

		vector<Rect> bounders;

		for (int i = 0; i < contours.size(); i++) {
			int area = contourArea(contours[i]);
			if (area < max_area && area > min_area) {
				bounders.push_back(boundingRect(contours[i]));
			}
		}

		Mat imgBox = imgRgb.clone();
		for (int i = 0; i < bounders.size(); i++) {
			rectangle(imgBox, bounders[i], Scalar(0, 0, 255), 2);
			circle(imgBox, Point(bounders[i].x + bounders[i].width / 2, bounders[i].y + bounders[i].height / 2), 10, Scalar(0, 0, 255), 2);
		}

		imshow("grey", imgBox);
		if (waitKey(30) == 27) break;
	}

}



















/*
#include "pch.h"
#include <iostream>
#include "opencv2/opencv.hpp"

using namespace cv;
using namespace std;

int main(int, char**)
{
	VideoCapture cap(0); // open the default camera
	if (!cap.isOpened())  // check if we succeeded
		return -1;

	Mat imgHsv;
	int hue_min = 64, hue_max = 94, sat_min = 157, sat_max = 255, val_min = 121, val_max = 223;
	int min_area = 10000, max_area = 10000000;
	for (;;)
	{
		Mat frame;
		cap >> frame; // get a new frame from camera
		Mat grayscale;
		cvtColor(frame, imgHsv, COLOR_RGB2GRAY);

		Mat imgGrey;
		inRange(imgHsv, Scalar(hue_min, sat_min, val_min), Scalar(hue_max, sat_max, val_max), imgGrey);

		Mat canny;
		Canny(imgGrey, canny, 10, 100);

		vector<vector<Point	>> contours;
		vector<Vec4i> hierarchy;

		findContours(canny, contours, hierarchy, RETR_EXTERNAL, CHAIN_APPROX_SIMPLE);
		vector<Rect> bounders;

		for (int i = 0; i < contours.size(); i++) {
			int area = contourArea(contours[i]);
			if (area < max_area && area > min_area) {
				bounders.push_back(boundingRect(contours[i]));
			}
		}

		Mat imgBox = frame.clone();
		for (int i = 0; i < bounders.size(); i++) {
			rectangle(imgBox, bounders[i], Scalar(0, 0, 255), 2);
			circle(imgBox, Point(bounders[i].x + bounders[i].width / 2, bounders[i].y + bounders[i].height / 2), 10, Scalar(0, 0, 255), 2);
		}

		imshow("grey", imgBox);
		if (waitKey(30) == 27) break;


		
	}
	// the camera will be deinitialized automatically in VideoCapture destructor
	return 0;
}*/