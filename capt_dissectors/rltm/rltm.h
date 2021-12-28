/* rltm.h
 *
 */


#ifndef __RLTM_DEF_H__
#define __RLTM_DEF_H__

#define RLTM_PATH_DIM          4096
#define RLTM_DEVICE            "/dev/hda1"
#define RLTM_CHECK_MAC_STR     "c81395ecf03a8a2ca513f245267044ac" /* md5sum "iSerm IP solurions  num:"
                                                                     "ca440762542f315ac2a8a30fce59318c" */
#define RLTM_PID_FILE          "/var/run/tizbin.pid"


struct pcap_ref {
    unsigned int dlt;
    unsigned long cnt;
    char *dev;
};

#endif /* __RLTM_DEF_H__ */
