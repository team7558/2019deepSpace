#include "MJPEGWriter.h"
int main()
{
    MJPEGWriter test(7777); //Creates the MJPEGWriter class to stream on the given port
    VideoCapture cap;
    bool ok = cap.open(1); //Opens webcam
    if (!ok)
    {
        printf("no cam found ;(.\n");
        pthread_exit(NULL);
    }
    Mat frame;
    cap >> frame;
    test.write(frame); //Writes a frame (Mat class from OpenCV) to the server
    frame.release();
    test.start(); //Starts the HTTP Server on the selected port
    while(cap.isOpened()){
        cap >> frame; 
        test.write(frame); 
        frame.release();
    }
    test.stop(); //Stops the HTTP Server
    exit(0);
}
