/* prism.h
 *
 */


#ifndef __PRISM_H__
#define __PRISM_H__

#define PRISM_DNAMELEN      16

typedef struct {
    unsigned int did;
    unsigned short status;
    unsigned short len;
    unsigned int data;
} __attribute__ ((packed)) prism_val;


typedef struct {
    unsigned int msgcode;
    unsigned int msglen;
    char devname[PRISM_DNAMELEN];
    prism_val hosttime;
    prism_val mactime;
    prism_val channel;
    prism_val rssi;
    prism_val sq;
    prism_val signal;
    prism_val noise;
    prism_val rate;
    prism_val istx;
    prism_val frmlen;
} __attribute__ ((packed)) prism_hdr;


#endif /* __PRISM_H__ */
