/* base.c
 */

#include <stdlib.h>
#include <pcap.h>
#include <string.h>

#include "captime.h"
#include "log.h"


static cap_time myctime;


cap_time *CapTime(char *file_name)
{
    char errbuf[PCAP_ERRBUF_SIZE];
    pcap_t *cap;
    struct pcap_pkthdr *h;
    const u_char *bytes;
    
    if (file_name == NULL)
        return NULL;
    
    memset(&myctime, 0, sizeof(cap_time));

    cap = pcap_open_offline(file_name, errbuf);
    if (cap == NULL) {
        LogPrintf(LV_ERROR, "Pcap error:%s\n", errbuf);
        return NULL;
    }
    
    if (pcap_next_ex(cap, &h, &bytes) == 1) {
        if (h->ts.tv_sec < 0) {
            myctime.start_sec = 0;
            myctime.end_sec = 0;
        }
        else {
            myctime.start_sec = h->ts.tv_sec;
            myctime.end_sec = h->ts.tv_sec;
        }
        myctime.start_usec = h->ts.tv_usec;
        myctime.end_usec = h->ts.tv_usec;
    }
    else {
        return NULL;
    }
    while (pcap_next_ex(cap, &h, &bytes) == 1) {
        if (h->ts.tv_sec > 0) {
            myctime.end_sec = h->ts.tv_sec;
            myctime.end_usec = h->ts.tv_usec;
        }
    }
    pcap_close(cap);

    return &myctime;
}
