/* analise.h
 *
 * $Id:  $
 *
 
 * 
 *
 *
     *
 *
 */


#ifndef __ANALISE_H__
#define __ANALISE_H__

#include <time.h>

#include "pei.h"
#include "packet.h"

#define SITE_PQ_LIMIT     100
#define SITE_BUFFER_DIM   1024
#define SITE_BIG_TIME     10000

/* pei queue */
typedef struct _peiq peiq;
struct _peiq {
    pei *pei;
    bool container;  /* if true it is likely a html page */
    bool contained;  /* if true it is a contained! */
    bool href;       /* it has a refer */
    time_t thref; /* sec */
    unsigned short nref; /* it is a refer for many contents */
    time_t tnref; /* sec */
    peiq *pre;
    peiq *nxt;
};


/** pei of same client */
typedef struct _anls_cln anls_cln;
struct _anls_cln {
    pstack_f *stack;             /**< stack base            */
    ftval ipx;                   /**< client IP             */
    enum ftype ip_tp;            /**< ip type: IPv4 or IPv6 */
};


int AnalyseInit(void);
int AnalysePei(pei *ppei);
int AnalyseEnd(void);


#endif /* __ANALISE_H__ */
