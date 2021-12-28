/* session_decoding.h
 * Session decoding monitoring
 */


#ifndef __SESSION_DECODING_H__
#define __SESSION_DECODING_H__

#include "dema.h"
#include "dbinterface.h"

int SeDeInit(char *cert, char *root_dir);
int SeDeFind(char *main_dir, podec *tbl, int dim);
int SeDeStart(dbconf *db_c, char *main_dir, int pol, int session, task *pid, bool rt, char *interf, char *filter);
int SeDeEnd(char *main_dir, int pol, int session, task *pid);
char *SeDeFileNew(char *main_dir, int pol, int session, bool *one);
char *SeDeFileDecode(char *main_dir, int pol, int session);
bool SeDeFileActive(char *filepath);
int SeDeNextSession(char *main_dir, int pol, int session);
int SeDeRun(task *pid, pid_t chld, bool clear);
int SeDeKill(podec *tbl, int id);


#endif /* __SESSION_DECODING_H__ */
