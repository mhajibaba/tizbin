/* analyse.c
 * analyse stack and time to realise pei
 */

#include "log.h"
#include "analyse.h"
#include "proto.h"

static int AnalyseSort(pei *ppei)
{
    return 0;
}


int AnalyseInit(void)
{
    return 0;
}


int AnalysePei(pei *ppei)
{
    PeiPrint(ppei);
    ProtStackFrmDisp(ppei->stack, TRUE);
    if (ppei->ret == TRUE) {
        ProtStackFrmDisp(ppei->stack, TRUE);
        LogPrintf(LV_WARNING, "Pei with return!");
    }
    PeiIns(ppei);

    return 0;
}


int AnalyseEnd(void)
{

    return 0;
}

