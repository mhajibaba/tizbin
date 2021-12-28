/* captime.h
 */


#ifndef __CAPTIME_H__
#define __CAPTIME_H__


/** capture time data */
typedef struct _cap_time cap_time;
struct _cap_time {
    unsigned long start_sec;
    unsigned long start_usec;
    unsigned long end_sec;
    unsigned long end_usec;
};


cap_time *CapTime(char *file_name);


#endif /* __CAPTIME_H__ */
