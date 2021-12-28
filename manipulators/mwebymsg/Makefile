# Makefile
#

# sub directory
SUBDIRS = 

# manipulator name
MANIPULA_NAME = mwebymsg

# tizbin library
XPL_LIB = $(ROOT_DIR)/common/libtizbin_core.a $(ROOT_DIR)/dispatch/libtizbin_dispatch.a $(ROOT_DIR)/dissectors/libtizbin_dissector.a

# src files
SRC = mmain.c mpei.c analyse.c

# obj files
OBJ = $(SRC:.c=.o)

# dep 
DEP = ../core/mmain.c mpei.c analyse.c

# compilation
LDFLAGS =  -L$(ROOT_DIR) -ldl -lpthread -lz -lssl -lcrypto $(shell pkg-config --libs json-c)

# cflags
CFLAGS += -I./include $(shell pkg-config --cflags json-c)

# verify GeoIP library source code
LDFLAGS += $(GEOIP_LIB)

# main cflags
MCFLAGS = $(CFLAGS) -DLOG_COMPONENT=-1

# To make it visible
export CC CCPP ROOT_DIR CFLAGS LDFLAGS INCLUDE_DIR


all: subdir $(MANIPULA_NAME)


$(MANIPULA_NAME): $(OBJ) $(XPL_LIB)
	$(CC) $(MCFLAGS) -o $@ $(OBJ) $(XPL_LIB) $(LDFLAGS)
	rm -f modules config tmp
	cp $(MANIPULA_NAME) $(ROOT_DIR)


subdir:
	@for dir in $(SUBDIRS) ; \
	   do $(MAKE) -C $$dir || exit 1; \
	 done


clean:
	@for dir in $(SUBDIRS) ; do $(MAKE) -C $$dir clean || exit 1; done
	rm -f $(MANIPULA_NAME) $(ROOT_DIR)/$(MANIPULA_NAME) *.o *.so *~ include/*~ .depend *.expand
	rm -f modules config tmp xdecode

install:
	cp $(MANIPULA_NAME) $(INSTALL_DIR)/bin

mmain.o: ../core/mmain.c
	$(CC) $(MCFLAGS) -c -o $@ $<

%.o: %.c
	$(CC) $(MCFLAGS) -c -o $@ $<


.depend: $(DEP)
	$(CC) -M $(MCFLAGS) $(DEP) > $@


sinclude .depend
