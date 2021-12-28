/* ieee80211.h
 * Routines for Wireless LAN 
 */


#ifndef __RTP_H__
#define __RTP_H__

#include <sys/types.h>
#include <sys/time.h>

#include "packet.h"

struct ieee80211hdr {
    union {
#if __BYTE_ORDER == __LITTLE_ENDIAN
        struct {
            unsigned char version:2;
            unsigned char type:2;
            unsigned char subtype:4;
            
            unsigned char to_ds:1;
            unsigned char from_ds:1;
            unsigned char more_frag:1;
            unsigned char retry:1;
            unsigned char pwrmgmt:1;
            unsigned char more_data:1;
            unsigned char wep:1;
            unsigned char order:1;
        } __attribute__ ((packed)) fc;
#elif __BYTE_ORDER == __BIG_ENDIAN
        struct {
            unsigned char subtype:4;
            unsigned char type:2;
            unsigned char version:2;
            
            unsigned char order:1;
            unsigned char wep:1;
            unsigned char more_data:1;
            unsigned char pwrmgmt:1;
            unsigned char retry:1;
            unsigned char more_frag:1;
            unsigned char from_ds:1;
            unsigned char to_ds:1;
        } __attribute__ ((packed)) fc;
#else
# error "Please fix <endian.h>"
#endif
        unsigned short fchdr;
    } u1;
    
    unsigned short duration;
    unsigned char addr1[6];
    unsigned char addr2[6];
    unsigned char addr3[6];
    
    union {
        struct {
#if __BYTE_ORDER == __LITTLE_ENDIAN
            unsigned short fragment:4;
            unsigned short sequence:12;
#elif __BYTE_ORDER == __BIG_ENDIAN
            unsigned short sequence:12;
            unsigned short fragment:4;
#endif
        } __attribute__ ((packed)) seq;
        
        unsigned short seqhdr;
    } u2;
    /* followed by 'u8 addr4[6];' if ToDS and FromDS is set in data frame
     */
    
    /* followed by wmmhdr is type = 2 and subtype = QoS data (8) or QoS
       NULL (12) 
    */
} __attribute__ ((packed));

#endif
