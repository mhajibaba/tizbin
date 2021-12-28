/* dispatch.h
 * Dispatch interface functions
 */


#ifndef __DISPATCH_H__
#define __DISPATCH_H__

#define DISP_INIT_FUN        "DispInit"
#define DISP_END_FUN         "DispEnd"
#define DISP_INDPEI_FUN      "DispInsPei"

int DispatchInit(const char *file_cfg);
int DispatchEnd(void);
int DispatchStatus(FILE *fp);
unsigned long DispatchPeiPending(void);


#endif /* __DISPATCH_H__ */
