/* mms_decode.h
 *
 *
 *
 
  *
 *
     *
 *
 *
 */


#ifndef __MMS_DECODE_H__
#define __MMS_DECODE_H__

#define MMS_VER_STR              10
#define MMS_STR_DIM           10240

typedef struct {
    char *ctype;    /* content type */
    char *name;     /* content name */
    int size;       /* content size */
    char *path;     /* content file path */
} mms_part;

typedef struct {
    char version[MMS_VER_STR];           /* mms version */
    char *msg_type;                      /* message type string */
    char *cont_type;                     /* content type */
    char *from;                          /* from */
    char *to;                            /* to */
    char *cc;                            /* cc */
    char *bcc;                           /* bcc */
    short nparts;                        /* number of part */
    mms_part *part;                      /* parts */
} mms_message;


int MMSInit(mms_message *msg);
int MMSDecode(mms_message *msg, const unsigned char *data, const int len, const char *tmp_path);
int MMSPrint(mms_message *msg);
int MMSFree(mms_message *msg);


#endif /* __MMS_DECODE_H__ */
