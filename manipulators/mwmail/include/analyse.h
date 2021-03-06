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

#include "pei.h"
#include "packet.h"

/* buffer size */
#define WMAIL_STR_DIM                   256
#define LINE_MAX_SIZE                   384

/* info file fileds */
#define WMAIL_FLD_SUBJECT          "SUBJECT:"
#define WMAIL_FLD_SUBJECT_DIM              8
#define WMAIL_FLD_FROM                "FROM:"
#define WMAIL_FLD_FROM_DIM                 5
#define WMAIL_FLD_TO                    "TO:"
#define WMAIL_FLD_TO_DIM                   3
#define WMAIL_FLD_CC                    "CC:"
#define WMAIL_FLD_CC_DIM                   3
#define WMAIL_FLD_MESSAGEID      "MESSAGEID:"
#define WMAIL_FLD_MESSAGEID_DIM           10
#define WMAIL_FLD_RECEIVED        "RECEIVED:"
#define WMAIL_FLD_RECEIVED_DIM             9
#define WMAIL_FLD_SENT                "SENT:"
#define WMAIL_FLD_SENT_DIM                 5
#define WMAIL_FLD_HTML                "HTML_"
#define WMAIL_FLD_HTML_DIM                 5
#define WMAIL_FLD_TXT                 "PART_"
#define WMAIL_FLD_TXT_DIM                  5
#define WMAIL_FLD_EML                  "EML:"
#define WMAIL_FLD_EML_DIM                  4
#define WMAIL_FLD_FILENAME        "FILENAME:"
#define WMAIL_FLD_FILENAME_DIM             9

/* service type */
#define WMAIL_SERVICE_ROSSOALICE        "rossoalice"
#define WMAIL_SERVICE_YAHOO             "yahoo"
#define WMAIL_SERVICE_YAHOO_V2          "yahoo_v2"
#define WMAIL_SERVICE_AOL               "aol"
#define WMAIL_SERVICE_AOL_V2            "aol_v2"
#define WMAIL_SERVICE_HOTMAIL           "hotmail"
#define WMAIL_SERVICE_GMAIL             "gmail"
#define WMAIL_SERVICE_YAHOO_ANDRO       "yahoo mobile"
#define WMAIL_SERVICE_LIBERO            "libero"
#define WMAIL_SERVICE_LIBERO_OLD        "libero old"
#define WMAIL_SERVICE_LIBERO_MOBI       "libero mobile"
#define WMAIL_SERVICE_REDIFF            "rediff"


typedef enum {
    WMS_YAHOO,
    WMS_YAHOO_V2,
    WMS_AOL,
    WMS_AOL_V2,
    WMS_HOTMAIL,
    WMS_GMAIL,
    WMS_YAHOO_DRIOD,
    WMS_ROSSOALICE,
    WMS_LIBERO,
    WMS_LIBERO_OLD,
    WMS_LIBERO_MOBI,
    WMS_REDIFF,
    WMS_NONE
} service;


int AnalyseInit(void);
int AnalysePei(pei *ppei);
int AnalyseEnd(void);


#endif /* __ANALYSE_H__ */
