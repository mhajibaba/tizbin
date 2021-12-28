/* pppoe.h
 *
 */


#ifndef __PPPOE_H__
#define __PPPOE_H__

#include <sys/types.h>
#include <sys/time.h>

typedef struct _pppoe_hdr pppoe_hdr;
struct _pppoe_hdr {
#if __BYTE_ORDER == __LITTLE_ENDIAN
    unsigned char ver:4;
    unsigned char type:4;
#elif __BYTE_ORDER == __BIG_ENDIAN
    unsigned char type:4;
    unsigned char ver:4;
#else
# error "Please fix <bits/endian.h>"
#endif
    unsigned char code;
    unsigned short sess_id;
    unsigned short len;
};


#endif
