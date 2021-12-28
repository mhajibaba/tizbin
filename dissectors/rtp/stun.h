/* stun.h
 * Dissector of STUN protocol
 *
 * $Id:  $
 *
 *
 
 
 *
 *
     *
 *
 */

#ifndef __STUN_H__
#define __STUN_H__


typedef struct _stun_hdr stun_hdr;
struct _stun_hdr {
    unsigned short type;      /**< message type */
    unsigned short len;       /**< message length */
    unsigned int mc;          /**< magic cookie */
    unsigned char tid[12];    /**< transaction ID */
} __attribute__((__packed__));


/* STUN message type */
#define STUN_MT_BUILD_REQ    0x0001
#define STUN_MT_BUILD_RESP   0x0101
#define STUN_MT_BUILD_ERR    0x0111
#define STUN_MT_SECR_REQ     0x0002
#define STUN_MT_SECR_RESP    0x0102
#define STUN_MT_SECR_ERR     0x0112

#endif /* __STUN_H__ */

