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


#ifndef __ANALYSE_H__
#define __ANALYSE_H__

#include <stdio.h>

#include "pei.h"
#include "packet.h"
#include "istypes.h"

/* buffer size */
#define HTTPFILE_STR_DIM                10240

/* info file fields */
typedef struct _file_http file_http;
struct _file_http {
    char url[HTTPFILE_STR_DIM]; /* source url */
    char file[HTTPFILE_STR_DIM]; /* file recontruction */
    char file_name[HTTPFILE_STR_DIM]; /* file name */
    char part_list[HTTPFILE_STR_DIM]; /* download list */
    char content_type[HTTPFILE_STR_DIM]; /* content type */
    size_t dim; /* original file size */
    size_t len; /* real file size */
    pei *ppei;  /* pei */
    bool range; /* reconstruct from range */
    unsigned long cnt; /* parts number */
};

typedef struct _file_part file_part;
struct _file_part {
    size_t start; /* offset start */
    size_t end;   /* offset end */
};

int AnalyseInit(void);
int AnalysePei(pei *ppei);
int AnalyseEnd(void);


#endif /* __ANALYSE_H__ */
