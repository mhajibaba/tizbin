/* dnsdb.h
 */


#ifndef __DNSDB_H__
#define __DNSDB_H__

#include <time.h>

#include "ftypes.h"

/* dns ip element */
typedef struct _dns_ip dns_ip;
struct _dns_ip {
    ftval ip;           /**< IP value */
    unsigned long idn;  /**< name index */
    unsigned long hash; /**< hash value */
    time_t tins;        /**< insert time */
    dns_ip *inf;        /**< next hash < */
    dns_ip *eq;         /**< next ip with same hash */
    dns_ip *sup;        /**< next hash > */
};


/* dns name element */
typedef struct _dns_name dns_name;
struct _dns_name {
    ftval name;         /**< domain name (string) */
    unsigned short ref; /**< number of reference in dns_ip */
};


int DnsDbInit(void);
int DnsDbInset(ftval *name, enum ftype ntype, ftval *ip, enum ftype itype);
int DnsDbSearch(ftval *ip, enum ftype itype, char *buff, int len);
int DnsDbStatus(unsigned int *ipn, unsigned int *namen, unsigned long *size);


#endif /* __DNSDB_H__ */
