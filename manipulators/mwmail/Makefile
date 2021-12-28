# Makefile
#

# sub directory
SUBDIRS = 

# manipulator name
MANIPULA_NAME = mwmail

# tizbin library
XPL_LIB = $(ROOT_DIR)/common/libtizbin_core.a $(ROOT_DIR)/dispatch/libtizbin_dispatch.a $(ROOT_DIR)/dissectors/libtizbin_dissector.a

# src files
SRC = mmain.c mpei.c analyse.c
PYSRC = wbm_aol.py wbm_live.py wbm_yahoo.py
PYSRC += wbm_libero.py wbm_yahoo_android.py wbm_rediff.py wbm_aol_v2.py wbm_gmail.py wbm_yahoo_v2.py wbm_rossoalice.py

# obj files
OBJ = $(SRC:.c=.o)

# dep 
DEP = ../core/mmain.c mpei.c analyse.c

# compilation
LDFLAGS =  -L$(ROOT_DIR) -ldl -lpthread -lz -lssl -lcrypto

# cflags
CFLAGS += -I./include

# python complier
PYCMPL = python3 -m compileall

# verify GeoIP library source code
LDFLAGS += $(GEOIP_LIB)

# main cflags
MCFLAGS = $(CFLAGS) -DLOG_COMPONENT=-1

# To make it visible
export CC CCPP ROOT_DIR CFLAGS LDFLAGS INCLUDE_DIR


all: subdir $(MANIPULA_NAME) pycmpl pth


$(MANIPULA_NAME): $(OBJ) $(XPL_LIB)
	$(CC) $(MCFLAGS) -o $@ $(OBJ) $(XPL_LIB) $(LDFLAGS)
	rm -f modules config tmp
	cp $(MANIPULA_NAME) $(ROOT_DIR)

pth:
	@cp wbm_*.py $(ROOT_DIR)
	@cp wbm_*.pyc $(ROOT_DIR)

pycmpl: $(PYSRC:.py=.pyc)
	chmod +x *.pyc
	if [ -d "__pycache__" ]; then rm -rf __pycache__; fi

subdir:
	@for dir in $(SUBDIRS) ; \
	   do $(MAKE) -C $$dir || exit 1; \
	 done


clean:
	@for dir in $(SUBDIRS) ; do $(MAKE) -C $$dir clean || exit 1; done
	rm -f $(MANIPULA_NAME) $(ROOT_DIR)/$(MANIPULA_NAME) *.o *.so *~ include/*~ .depend *.expand
	rm -f $(ROOT_DIR)/wbm_*.pyc $(ROOT_DIR)/wbm_*.py
	rm -f modules config tmp xdecode
	rm -rf __pycache__
	rm wbm_*.pyc
	

install:
	cp $(MANIPULA_NAME) $(INSTALL_DIR)/bin
	cp wbm_*.py $(INSTALL_DIR)/bin
	cp wbm_*.pyc $(INSTALL_DIR)/bin

mmain.o: ../core/mmain.c
	$(CC) $(MCFLAGS) -c -o $@ $<

%.o: %.c
	$(CC) $(MCFLAGS) -c -o $@ $<

%.pyc: %.py
	rm -f $@
	if [ -d "__pycache__" ]; then rm -f __pycache__/*; fi
	$(PYCMPL) $< 
	if [ -d "__pycache__" ]; then mv __pycache__/*.pyc $@; fi

.depend: $(DEP)
	$(CC) -M $(MCFLAGS) $(DEP) > $@


sinclude .depend
