#include <iostream>
#include <pthread.h>
#include <unistd.h>

#include "opencv2/opencv.hpp"
#include "udp_client_server.h"

using namespace std;
using namespace udp_client_server;
using namespace cv;

const int WIDTH = 300, HEIGHT = 200;
const int COMPRESSION_QUALITY = 75;
const string IP = "10.75.56.181";
const int PORT = 3000;

void sendFrame(vector<uchar> buff);

main(int argc, char const *argv[]){
	cout<<IP<<endl;
	Mat frame;
	VideoCapture cap(1);
	namedWindow("frame", WINDOW_NORMAL);
	for (;;){
		cap >> frame;
		if (frame.empty()) break;
		resize(frame, frame, Size(WIDTH,HEIGHT), 0,0, INTER_LANCZOS4);
		vector<uchar> buff;
		vector<int> param(2);
		param[0] = IMWRITE_JPEG_QUALITY;
		param[1] = COMPRESSION_QUALITY;
		imencode(".jp2", frame, buff, param);
		sendFrame(buff);		
		imshow("frame", frame);
		if (waitKey(30) == 27) break;
	}
    return 0;
}

void sendFrame(vector<uchar> buff){
	UdpClient sender(IP, 3000);
	sender.send(reinterpret_cast<char*>(buff.data()), buff.size());
	cout << "sent frame with size: " << buff.size() << endl;
}
	


