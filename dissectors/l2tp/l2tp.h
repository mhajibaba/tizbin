/* l2tp.h
 *
 * $Id:$
 *
 *
 
  *
 *
     *
 *
 */


#ifndef __L2TP_H__
#define __L2TP_H__

typedef struct {
    unsigned char p:1;   /* Priority */
    unsigned char o:1;   /* Offset */
    unsigned char d2:1;
    unsigned char s:1;   /* Sequence */
    unsigned char d1:1;
    unsigned char d0:1;
    unsigned char l:1;   /* Length */
    unsigned char t:1;   /* Type */

    unsigned char ver:4; /* version */
    unsigned char d6:1;
    unsigned char d5:1;
    unsigned char d4:1;
    unsigned char d3:1;
} l2tphdr;

#endif /* __L2TP_H__ */
