#include "opencv2/opencv.hpp"
#include <iostream>
#include <chrono>
#include <cstdio>
#include <thread>
#include "ntcore.h"
#include "networktables/NetworkTable.h"

using namespace std;
using namespace cv;

int hue_min = 64, hue_max = 94, sat_min = 157,sat_max=255, val_min = 121, val_max = 223;
int min_area = 10000, max_area = 10000000;

int main() {
	
	NetworkTable::SetClientMode();
	NetworkTable::SetTeam(7556);
	
	auto rawValues = NetworkTable::GetTable("rawValues");
	
	VideoCapture cap(1);
	if (!cap.isOpened()) return -1;
	
	namedWindow("bgr", 1);
	
	int i = 0;

	while(true){
		Mat frame;
		cap >> frame;
		//imshow("bgr", frame);
		
		rawValues->PutNumber("distance", i);
		
		
		
		if (waitKey(30) >= 0) break;
	}
	/*
	while(true){
		Mat frame;
		cap >> frame;
		Mat imgHsv;
		Mat imgRgb = frame;
			                            
		cvtColor(imgRgb, imgHsv, CV_BGR2HSV);
	 
		Mat imgGrey;
		inRange(imgHsv, Scalar(hue_min, sat_min, val_min),Scalar(hue_max, sat_max, val_max),imgGrey);
		
		Mat canny;
		Canny(imgGrey, canny, 10, 100);
		
		vector<vector<Point>> contours;
		
		vector<Vec4i> hierarchy;
		
		findContours(canny, contours, hierarchy, RETR_EXTERNAL, CHAIN_APPROX_SIMPLE);
		
		vector<Rect> bounders;
		
		for(size_t i = 0; i < contours.size(); i++){
			int area = contourArea(contours[i]);
			if(area <max_area && area > min_area){
				bounders.push_back(boundingRect(contours[i]));
			} 
		}
		
		Mat imgBox = imgRgb.clone();
		for (size_t i = 0; i<bounders.size(); i++){
			rectangle(imgBox, bounders[i], Scalar(0,0,255),2);
		}
		imshow("grey", imgBox);		
		
		if (waitKey(30) >= 0) break;
		//m_visionNetworkTable->PutNumber("X", 4.0);
	}
	*/
	
	return 0;
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*VideoCapture cap(1);
	if (!cap.isOpened()) return -1;
	
	namedWindow("bgr", 1);
	
	NetworkTable::SetClientMode();
	NetworkTable::SetTeam(7558);

	auto m_visionNetworkTable = NetworkTable::GetTable("testing");
	
	while(true){
		Mat bgr_img;
		cap >> bgr_img;
		
		imshow("bgr", bgr_img);
		
		m_visionNetworkTable->PutNumber("X", 4.0);
		
		if (waitKey(30) >= 0) break;
	}
	
	*/
	
	/*
	VideoCapture cap(1);
	if (!cap.isOpened()) return -1;

	namedWindow("bgr", 1);
	
	NetworkTable::SetClientMode();
    NetworkTable::SetTeam(7558);
    
    auto table = NetworkTable::GetTable("firstopencv");
	
	while (true) {
		Mat bgr_img;
		cap >> bgr_img;
		
		Scalar avg = mean(bgr_img);
		//cout << avg[0] << endl;
		
		imshow("bgr", bgr_img);

		if (waitKey(30) >= 0) break;
		
		table->PutNumber("r", avg[0]);
		table->PutNumber("g", avg[1]);
		table->PutNumber("b", avg[2]);
	}
	* */


