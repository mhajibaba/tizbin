/* snoop.h
 * prototype of capture dissector
 */

#ifndef __SNOOP_H__
#define __SNOOP_H__

/* information necessary to understand Solaris Snoop output */
struct snoop_file_header {
    char format_name[8];        /* should be "snoop\0\0\0" */
    unsigned int version;       /* current version is "2" */
    unsigned int mac;           /* hardware type */
};

struct snoop_packet_header {
    unsigned int len;
    unsigned int tlen;
    unsigned int blen;
    unsigned int unused3;
    unsigned int secs;
    unsigned int usecs;
};

#endif /* __SNOOP_H__ */
