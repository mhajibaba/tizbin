/* mmsdec.c
 * Test code for mms decoder
 *
 *
 *
 
  *
 *
     *
 *
 *
 */

#include <stdio.h>
#include <string.h>

#include "mms_decode.h"

#define MMS_RAW_DIM  1024*500


void Usage(char *argv[])
{
    printf("Usage:\n");
    printf("\t%s <mms_file>\n\n", argv[0]);
}

int main(int argc, char *argv[])
{
    int len;
    char *file = argv[1];
    unsigned char mms_raw[MMS_RAW_DIM];
    mms_message msg;
    FILE *fp;

    if (argc != 2) {
        Usage(argv);
        return 0;
    }

    fp = fopen(file, "r");
    if (fp != NULL) {
        len = fread(mms_raw, 1, MMS_RAW_DIM, fp);
        memset(&msg, 0, sizeof(mms_message));
        MMSDecode(&msg, mms_raw, len, "./");
        MMSPrint(&msg);
        MMSFree(&msg);
        fclose(fp);
    }

    return 0;
}
