#ifndef UDP_CLIENT_SERVER_H
#define UDP_CLIENT_SERVER_H

#include <sys/types.h>
#include <sys/socket.h>
#include <netdb.h>
#include <stdexcept>

namespace udp_client_server {

class UdpClientServerRuntimeError: public std::runtime_error {
public:
    UdpClientServerRuntimeError(const char *w): std::runtime_error(w) {}
};

class UdpBase {
protected:
    UdpBase(const std::string& addr, int port);

public: 
    ~UdpBase();

    int getSocket() const;
    int getPort() const;
    std::string getAddr() const;

protected:
    int socket;
    int port;
    std::string addr;
    struct addrinfo * addrInfo;
    char decimal_port[16];
};

class UdpClient : public UdpBase{
public:
    UdpClient(const std::string& addr, int port);

    int send(const char *msg, size_t size);
};

class UdpServer : public UdpBase{
public:
    UdpServer(const std::string& addr, int port);

    int receive(char *msg, size_t maxSize);
    int timedReceive(char *msg, size_t maxSize, int maxWaitMs);
};

}

#endif 
