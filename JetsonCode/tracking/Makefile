NT_LIB_PATH="/7558/ntcore/"
NT_INCLUDE_PATH="/7558/ntcore/include/"
WPI_INCLUDE_PATH="/7558/ntcore/wpiutil/include/"
CSCORE_LIB_PATH="/home/nvidia/cscore/"
CSCORE_INCLUDE_PATH="/home/nvidia/cscore/src/main/native/include"

FILENAME="Main.cpp"
OUTNAME="main"

all: clean
	g++ -std=c++11 -g -Wall \
	-L$(CSCORE_LIB_PATH) \
	-L$(NT_LIB_PATH) \
	 $(FILENAME) \
	-I$(NT_INCLUDE_PATH) -I$(WPI_INCLUDE_PATH) -I$(CSCORE_INCLUDE_PATH) \
	`pkg-config --cflags --libs opencv gstreamer-1.0 gtk+-2.0 glib-2.0` \
	-lntcore -lwpiutil -lpthread -lgstapp-1.0 -lgstriff-1.0 -lgstbase-1.0 -lgstvideo-1.0 -lgstpbutils-1.0 \
	-o $(OUTNAME)

clean:

run: all
	./$(OUTNAME)

Debug: all

