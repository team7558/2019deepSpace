#include <string.h>
#include <unistd.h>
#include <iostream>
#include <stdio.h>
#include <errno.h>

#include "udp_client_server.h"

using namespace std;

namespace udp_client_server {

UdpBase::UdpBase(const std::string& addr, int port)
:port(port) 
,addr(addr)
{
    snprintf(decimal_port, sizeof(decimal_port), "%d", port);
    decimal_port[sizeof(decimal_port) / sizeof(decimal_port[0]) - 1] = '\0';
    struct addrinfo hints;
    memset(&hints, 0, sizeof(hints));
    hints.ai_family = AF_UNSPEC;
    hints.ai_socktype = SOCK_DGRAM;
    hints.ai_protocol = IPPROTO_UDP;
    int r(getaddrinfo(addr.c_str(), decimal_port, &hints, &addrInfo));
    if(r != 0 || addrInfo == NULL)
    {
        throw UdpClientServerRuntimeError(("invalid address or port: \"" + addr + ":" + decimal_port + "\"").c_str());
    }
    socket = ::socket(addrInfo->ai_family, SOCK_DGRAM | SOCK_CLOEXEC, IPPROTO_UDP);
    if(socket == -1)
    {
        freeaddrinfo(addrInfo);
        throw UdpClientServerRuntimeError(("could not create socket for: \"" + addr + ":" + decimal_port + "\"").c_str());
    }
}

UdpBase::~UdpBase(){
    freeaddrinfo(addrInfo);
    close(socket);
}

int UdpBase::getSocket() const{
    return socket;
}

int UdpBase::getPort() const{
    return port;
}

std::string UdpBase::getAddr() const{
    return addr;
}

////////////////////////////////////////////////////////////////////////////////

UdpClient::UdpClient(const std::string& addr, int port)
:UdpBase(addr, port)
{}

int UdpClient::send(const char *msg, size_t size){
    return sendto(socket, msg, size, 0, addrInfo->ai_addr, addrInfo->ai_addrlen);
}

/////////////////////////////////////////////////////////////////////////////////

UdpServer::UdpServer(const std::string& addr, int port)
:UdpBase(addr, port)
{
    int r(bind(socket, addrInfo->ai_addr, addrInfo->ai_addrlen));
    if(r != 0)
    {
        freeaddrinfo(addrInfo);
        close(socket);
        throw UdpClientServerRuntimeError(("could not bind UDP socket with: \"" + addr + ":" + decimal_port + "\"").c_str());
    }
}

int UdpServer::receive(char *msg, size_t maxSize){
    return ::recv(socket, msg, maxSize, 0);
}

int UdpServer::timedReceive(char *msg, size_t maxSize, int maxWaitMs){
    fd_set s;
    FD_ZERO(&s);
    FD_SET(socket, &s);
    struct timeval timeout;
    timeout.tv_sec = maxWaitMs / 1000;
    timeout.tv_usec = (maxWaitMs % 1000) * 1000;
    int retval = select(socket + 1, &s, &s, &s, &timeout);
    if(retval == -1)
    {
        // select() set errno accordingly
        return -1;
    }
    if(retval > 0)
    {
        // our socket has data
        return ::recv(socket, msg, maxSize, 0);
    }

    // our socket has no data
    errno = EAGAIN;
    return -1;
}

}

