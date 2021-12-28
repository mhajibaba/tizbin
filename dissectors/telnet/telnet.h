/* telnet.h
 * Dissector of telnet
 */


#ifndef __TELNET_H__
#define __TELNET_H__

/* standard port */
#define TCP_PORT_TELNET                   23

/* path & buffer size */
#define TELNET_FILENAME_PATH_SIZE        256
#define TELNET_BUF_SIZE                  256
#define TELNET_LOGIN_SIZE               (1024*512)

/* packets limit for TelnetVerify, TelnetCheck */
#define TELNET_PKT_LIMIT                   10
#define TELNET_PKT_CHECK                   5


#endif /* __TELNET_H__ */
