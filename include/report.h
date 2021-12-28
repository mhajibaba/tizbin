/* report.h
 * report in a socket connection the tizbin status/statistics
 */


#ifndef __REPORT_H__
#define __REPORT_H__

/** protocol report */
typedef struct _prot_rep_ prot_rep;
struct _prot_rep_ {
    char           *name;      /**< IANA protocol name */
    int            ftbl_dim;   /**< number of element of flow tbl */
    int            flow_num;   /**< number of flow for protocol */
#ifdef XPL_PEDANTIC_STATISTICS
    unsigned long pkt_tot;     /**< total number of packet */
#endif
};


int ReportInit(void);
int ReportSplash(void);
void ReportFilesDescr(void);

#endif /* __REPORT_H__ */
