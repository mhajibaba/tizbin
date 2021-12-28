/* ipv6.h
 * Definitions for IPv6 packet disassembly
 */


#ifndef __IPV6_H__
#define __IPV6_H__


#include <arpa/inet.h>


/*
 * Definition for internet protocol version 6.
 * RFC 1883
 */
struct ipv6hdr {
    unsigned char prio:4;  /* 4 bits priority */
    unsigned char ver:4;   /* 4 bits version */
    unsigned char flow[3]; /* 20 bits of flow-ID */
    unsigned short plen;   /* payload length */
    unsigned char  nxt;	   /* next header */
    unsigned char  hlim;   /* hop limit */
    struct in6_addr saddr; /* source address */
    struct in6_addr daddr; /* destination address */
};

struct ipv6ext {
    unsigned char nxt; /* next header */
    unsigned char len; /* ext payload length = (len + 1)^3 */
};

#endif /* __IPV6_H__ */
