/* ppi.h
 *
 *
 *
 
  *
 *
     *
 *
 */

#ifndef __PPI_H__
#define __PPI_H__


typedef struct _ppi_header_t ppi_header;
struct _ppi_header_t {
	unsigned char version;
	unsigned char flags;
	unsigned short len;
	unsigned int dlt;
} __attribute__((packed));


#endif
