/* syslog.h
 *
 */


#ifndef __SYSLOG_H__
#define __SYSLOG_H__


/* standard port */
#define TCP_PORT_UDP_SYSLOG              514

/* path buffer size */
#define SYSLOG_FILENAME_PATH_SIZE        256

/* packets limit for SyslogVerify, SyslogCheck */
#define SYSLOG_PKT_VER_LIMIT             10
#define SYSLOG_PKT_CHECK                 7
#define SYSLOG_PKT_VER                   3
#define SYSLOG_PKT_MIN_LEN               6

#endif /*__SYSLOG_H__ */
