main: main.o udp_client_server.o
	g++ -o main main.o udp_client_server.o -lpthread `pkg-config --cflags --libs opencv`

main.o: main.cpp 
	g++ -c main.cpp 

udp_client_server.o: udp_client_server.cpp
	g++ -c udp_client_server.cpp
