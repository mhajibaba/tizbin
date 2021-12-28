# Makefile
#

# root directory
ROOT_DIR = $(shell pwd)
ifndef INSTALL_DIR
INSTALL_DIR = /opt/tizbin
endif

# sub directory
SUBDIRS = 

# tizbin library
XPL_LIB =

# src file
SRC = trigcap.c

# compilation
INCLUDE_DIR = -I$(ROOT_DIR)/include
LDFLAGS = -L$(ROOT_DIR) -lpcap
CFLAGS = -rdynamic $(INCLUDE_DIR) -Wall -g -ggdb -fPIC -D_FILE_OFFSET_BITS=64

# performance
ifdef GPROF
CFLAGS += -pg
endif


# To make it visible
export CC CCPP ROOT_DIR CFLAGS LDFLAGS INCLUDE_DIR INSTALL_DIR

all: subdir trigcap

help:
	@echo "Flags:"
	@echo "    VER=<string>  --> string is the release name, otherwise the date is the name"
	@echo "    GPROF=1       --> enable gprof compilation"
	@echo " "
	@echo "Comands:"
	@echo "    help    --> this help"
	@echo "    clean   --> clean"
	@echo "    tgz     --> project snapshot"
	@echo "    install --> install in /opt/tizbin"
	@echo " "

# version name
ifndef VER
VER = -$(shell date +%Y_%m_%d)
endif

trigcap: $(SRC:.c=.o)
	$(CC) $(CFLAGS) -o $@ $(SRC:.c=.o) $(LDFLAGS)


subdir:
	@for dir in $(SUBDIRS) ; \
	   do $(MAKE) -C $$dir || exit 1; \
	 done


clean: reset
	@for dir in $(SUBDIRS) ; do $(MAKE) -C $$dir clean ; done
	rm -f include/*~
	rm -f trigcap *.o *~ *.log .depend val.* *.expand


install: all
	mkdir -p $(INSTALL_DIR)
	mkdir -p $(INSTALL_DIR)/bin
	cp -a trigcap $(INSTALL_DIR)/bin
	strip -s $(INSTALL_DIR)/bin/trigcap

.PHONY: reset
reset:
	rm -rf tmp/*


%.o: %.c
	$(CC) $(CFLAGS) -c -o $@ $< 


tgz: clean
	cd ..; tar cvzf trigcap$(VER).tgz --exclude cscope.files --exclude cscope.out --exclude CVS --exclude release trigcap
	mkdir -p release
	mv ../trigcap$(VER).tgz release
	rm -f release/*.gpg



.depend: $(SRC)
	$(CC) -M $(CFLAGS) $(SRC) > $@


sinclude .depend
