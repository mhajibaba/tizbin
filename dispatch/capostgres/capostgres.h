/* capostgres.h
 *
 */


#ifndef __CALITE_H__
#define __CALITE_H__

#define XPCAP_DATE          "to_timestamp(%ld)"
#define XPCAP_TIME          "to_timestamp(%ld)"

#define CAL_STR_DIM             1024
#define CAL_QUERY_DIM           10240
#define CAL_GROUP_INSERT        400

/* dir */
#define DIR_DATA               "%s/data"
#define DIR_HISTORY            "%s/history"

/* configuration file */
#define CFG_PAR_XDECODE            "DISPATCH_DECODED_DIR"
#define CFG_PAR_DB_HOST            "DB_HOST"
#define CFG_PAR_DB_NAME            "DB_NAME"
#define CFG_PAR_DB_USER            "DB_USER"
#define CFG_PAR_DB_PASSWORD        "DB_PASSWORD"
#define CFG_BUFF_SIZE              512

typedef struct __dbconf_t dbconf;
struct __dbconf_t {
    char name[CFG_BUFF_SIZE];       /* DB name */
    char user[CFG_BUFF_SIZE];       /* DB uaser name */
    char password[CFG_BUFF_SIZE];   /* DB password */
    char host[CFG_BUFF_SIZE];       /* DB host name */
};

#define CAL_HOST_ID_ADD         30
typedef struct {
    int id;                  /* DB id */
    ftval ip;                /* IP address */
    enum ftype type;         /* ip type */
} host_id;

#define CAL_QUERY_IP_LAST_ID        "SELECT id FROM ips_%i ORDER BY id DESC LIMIT 1;"
#define CAL_QUERY_IP_TEMPLATE       "INSERT INTO ips_%i (id, dataset_id, ip) VALUES (%i, %i, '%s');"
#define CAL_QUERY_IP_SEARCH         "SELECT id FROM ips_%i WHERE ip='%s';"
#define CAL_QUERY_ITEM_TEMPLATE     "INSERT INTO items_%i (dataset_id, capfile_id, cdate, ctime, year, month, week, hour, min5, days, seconds, flow_info, metadata, ip_src, ip_dst, ips_id, ipd_id, dns, port_src, port_dst, port_grp, l4prot, l7prot, lat, long, country, bsent, brecv, blsent, blrecv, pktsent, pktrecv, tracesent, tracerecv, images, duration, start_pkt, offset_pkt, eth_src, eth_dst, encaps) VALUES (%u, %u, "XPCAP_DATE", "XPCAP_TIME", '%i', '%i', '%i', '%i', '%i', '%i', '%i', '%s', '%s', '%s', '%s', '%lu', '%lu', '%s', '%s', '%s', '%li', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %lu, '%lu', '%zu', '%s', '%s', '%s');"

#endif /* __CALITE_H__ */
