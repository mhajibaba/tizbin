/* disp_manipula.h
 * Disspatcher-manipulator functions protocols
 *
 */

#ifndef __DISP_MANUPULA_H__
#define __DISP_MANIPULA_H__

#include "pei.h"

int DispManipInit(void);
int DispManipEnd(void);
int DispManipPutPei(pei *ppei);
pei *DispManipGetPei(int sock);


#endif /* __DISP_MANIPULA_H__ */
