# Makefile
#
# $Id: $
#
# tizbin - Internet Traffic Decoder
# By Majid Hajibaba <m.hajibaba@gmail.com>
#

# root directory
ROOT_DIR = $(shell pwd)

ifndef DEFAULT_DIR
DEFAULT_DIR = /opt/tizbin
endif
ifdef DESTDIR
INSTALL_DIR = $(DESTDIR)/$(DEFAULT_DIR)
else
INSTALL_DIR = $(DEFAULT_DIR)
endif

# sub directory
SUBDIRS = capt_dissectors common dissectors dispatch manipulators system

# tizbin library
XPL_LIB = $(ROOT_DIR)/common/libtizbin_core.a $(ROOT_DIR)/capt_dissectors/libtizbin_capt.a $(ROOT_DIR)/dispatch/libtizbin_dispatch.a $(ROOT_DIR)/dissectors/libtizbin_dissector.a

# src file
SRC = tizbin.c report.c

# compilation
INCLUDE_DIR = -I$(ROOT_DIR)/include -I$(ROOT_DIR)/common/include -I$(ROOT_DIR)/dissectors/include -I$(ROOT_DIR)/capt_dissectors/include -I$(ROOT_DIR)/dispatch/include
LDFLAGS = -L$(ROOT_DIR) -ldl -lpthread -lz -lssl -lcrypto
CFLAGS = -rdynamic $(INCLUDE_DIR) -Wall -fPIC -D_FILE_OFFSET_BITS=64 -U_FORTIFY_SOURCE
MODULE_PATH = modules

# pedantic statistics
CFLAGS += -DXPL_PEDANTIC_STATISTICS=1

# optmimization
ifdef O3
CFLAGS += -O3
 ifndef CHECKOFF
 CHECKOFF = 1
 endif
else
#CFLAGS += -g -ggdb -dr
CFLAGS += -g -ggdb -O0
endif

# performance
ifdef GPROF
CFLAGS += -pg
endif

# table of flows sorted
ifndef FTBL_NOSORT
CFLAGS += -DFTBL_SORT=1
endif

# enable check code
ifndef CHECKOFF
CFLAGS += -DXPL_CHECK_CODE=1
endif

# architeture type
ifdef CROSS_COMPILE
CC = $(CROSS_COMPILE)gcc
STRIP = $(CROSS_COMPILE)strip
else
STRIP = strip
CFLAGS += -DXPL_X86=1
endif

# timeout connection in realtime acq
ifdef RT_TO
CFLAGS += -DXPL_REALTIME=1
endif

# verify GeoIP library source code
ifdef DISABLE_GEOIP
CFLAGS += -DGEOIP_LIBRARY=0
else
GEOIP_LIB = $(shell pkg-config --libs libmaxminddb)
LDFLAGS += $(GEOIP_LIB)
CFLAGS += -DGEOIP_LIBRARY=1
INCLUDE_DIR += $(shell pkg-config --cflags libmaxminddb)
endif

# nDPI local version (from source code)
ifdef LOCAL_NDPI
$(shell ln -sf $(ROOT_DIR)/../nDPI/src/include $(ROOT_DIR)/../nDPI/src/include/libndpi)
endif

# main cflags
MCFLAGS = $(CFLAGS) -DLOG_COMPONENT=-1

# To make it visible
export CC CCPP ROOT_DIR CFLAGS LDFLAGS INCLUDE_DIR INSTALL_DIR GEOIP_LIB LOCAL_NDPI

all: subdir tizbin mdl check_version

help:
	@echo "Flags:"
	@echo "    VER=<string>      --> string is the release name, otherwise the date is the name"
	@echo "    LOCAL_NDPI=1      --> will be used local nDPI (not installed), from ../nDPI and linked statically"
	@echo "    GPROF=1           --> enable gprof compilation"
	@echo "    FTBL_NOSORT=1     --> disable sort in flows manager"
	@echo "    DISABLE_GEOIP=1   --> disable GeoIP library"
	@echo "    O3=1              --> enable optimization"
	@echo " "
	@echo "Comands:"
	@echo "    help    --> this help"
	@echo "    reset   --> delete default tmp data"
	@echo "    clean   --> clean"
	@echo "    tgz     --> project snapshot"
	@echo "    install --> install in $(INSTALL_DIR)"
	@echo "    check_version --> check version"
	@echo " "

# version name
ifndef VER
VER = $(shell date +%Y_%m_%d)
endif


tizbin: $(SRC:.c=.o) $(XPL_LIB)
	$(CC) $(MCFLAGS) -o $@ $(SRC:.c=.o) $(XPL_LIB) $(LDFLAGS)
	mkdir -p tmp
	mkdir -p xdecode


subdir:
	@for dir in $(SUBDIRS) ; \
	   do $(MAKE) -C $$dir || exit 1; \
	 done


mdl:
	mkdir -p $(MODULE_PATH)
	cp -a dissectors/*/*.so $(MODULE_PATH)
	cp -a capt_dissectors/*/*.so $(MODULE_PATH)
	cp -a dispatch/*/*.so $(MODULE_PATH)
	chmod +x ./check_version.sh


clean: reset
	@for dir in $(SUBDIRS) ; do $(MAKE) -C $$dir clean; done
	rm -f tizbin *.o *~ *.log .depend val.* *.expand
	rm -rf $(MODULE_PATH)
	rm -rf debian/tizbin*
	rm -f webmail/*/*~
	rm -f */*~
	rm -f */*/*~
	rm -f *.tgz

installcp: all 
	rm -rf $(INSTALL_DIR)/*
	mkdir -p $(INSTALL_DIR)
	chmod 777 $(INSTALL_DIR)
	mkdir -p $(INSTALL_DIR)/bin
	mkdir -p $(INSTALL_DIR)/bin/modules
	mkdir -p $(INSTALL_DIR)/script
	mkdir -p $(INSTALL_DIR)/script/db
	mkdir -p $(INSTALL_DIR)/cfg
	mkdir -p $(INSTALL_DIR)/log
# copy user defined fonts
	mkdir -p	/usr/share/fonts/truetype/tizbinFonts/
	cp font/IRCOMPSET*	/usr/share/fonts/truetype/tizbinFonts/
	cp -a tizbin $(INSTALL_DIR)/bin
#	strip -s $(INSTALL_DIR)/bin/tizbin
	cp -a $(MODULE_PATH)/* $(INSTALL_DIR)/bin/modules
#	strip -s  $(INSTALL_DIR)/bin/modules/*.so
	cp -a config/tizbin_install_*.cfg $(INSTALL_DIR)/cfg
	cp -a config/tizbin_cli_fix.cfg $(INSTALL_DIR)/cfg/tizbin_cli.cfg
	cp -a config/tizbin_cli_fix_nc.cfg $(INSTALL_DIR)/cfg/tizbin_cli_nc.cfg
	cp -a config/mfbc_install_*.cfg $(INSTALL_DIR)/cfg
	cp -a config/mfbc_cli_fix.cfg $(INSTALL_DIR)/cfg/mfbc_cli.cfg
	cp -a config/mwmail_install_*.cfg $(INSTALL_DIR)/cfg
	cp -a config/mwmail_cli_fix.cfg $(INSTALL_DIR)/cfg/mwmail_cli.cfg
	cp -a config/mfile_install_*.cfg $(INSTALL_DIR)/cfg
	cp -a config/mfile_cli_fix.cfg $(INSTALL_DIR)/cfg/mfile_cli.cfg
	cp -a config/mpaltalk_install_*.cfg $(INSTALL_DIR)/cfg
	cp -a config/mpaltalk_cli_fix.cfg $(INSTALL_DIR)/cfg/mpaltalk_cli.cfg
	cp -a config/mwebymsg_install_*.cfg $(INSTALL_DIR)/cfg
	cp -a config/mwebymsg_cli_fix.cfg $(INSTALL_DIR)/cfg/webymsg_cli.cfg
	cp -a config/tcp_grb_dig.cfg $(INSTALL_DIR)/cfg/tcp_grb_dig.cfg
	
ifeq ($(wildcard GeoLite2-City.mmdb), GeoLite2-City.mmdb)
	cp -a GeoLite2-City.mmdb $(INSTALL_DIR)/GeoLite2-City.mmdb
endif
ifeq ($(wildcard GeoLite2-Country.mmdb), GeoLite2-Country.mmdb)
	cp -a GeoLite2-Country.mmdb $(INSTALL_DIR)/GeoLite2-Country.mmdb
endif
ifeq ($(wildcard pcl6), pcl6)
	cp -a pcl6 $(INSTALL_DIR)/bin
endif
ifeq ($(wildcard videosnarf), videosnarf)
	cp -a videosnarf $(INSTALL_DIR)/bin
endif
# manipulators
	$(MAKE) -C manipulators install
	$(MAKE) -C system install

#install new fonts
	fc-cache -fv

# install and permission
ifndef DESTDIR
install: installcp
	chmod 777 $(INSTALL_DIR)
	chmod 777 $(INSTALL_DIR)/cfg
	chmod a+w $(INSTALL_DIR)/cfg/*
#	chmod -R 777 $(INSTALL_DIR)/xi/app/tmp
#	mkdir -p $(INSTALL_DIR)/xi/app/tmp/cache
#	mkdir -p $(INSTALL_DIR)/xi/app/tmp/cache/models
#	mkdir -p $(INSTALL_DIR)/xi/app/tmp/cache/persistent
#	mkdir -p $(INSTALL_DIR)/xi/app/tmp/cache/views
#	chmod -R 777 $(INSTALL_DIR)/xi/app/tmp/cache
	chmod +x $(DESTDIR)/opt/tizbin/script/*
else
install: installcp
	chmod 777 $(INSTALL_DIR)
	chmod 777 $(INSTALL_DIR)/cfg
	chmod a+w $(INSTALL_DIR)/cfg/*
#	chmod -R 777 $(INSTALL_DIR)/xi/app/tmp
	mkdir -p $(DESTDIR)/etc/apache2/sites-available/
	mkdir -p $(DESTDIR)/etc/apache2/sites-enabled/
	cp $(INSTALL_DIR)/cfg/apache_xi $(DESTDIR)/etc/apache2/sites-available/httpd-tizbin.conf
	mkdir -p $(DESTDIR)/etc/httpd/conf/extra
	cp $(INSTALL_DIR)/cfg/httpd_xi $(DESTDIR)/etc/httpd/conf/extra/httpd-tizbin.conf
	mkdir -p $(DESTDIR)/usr/lib/systemd/system
	cp tizbin.service $(DESTDIR)/usr/lib/systemd/system/
#	mkdir -p $(DESTDIR)/opt/tizbin/xi/app/tmp/cache
#	mkdir -p $(DESTDIR)/opt/tizbin/xi/app/tmp/cache/models
#	mkdir -p $(DESTDIR)/opt/tizbin/xi/app/tmp/cache/persistent
#	mkdir -p $(DESTDIR)/opt/tizbin/xi/app/tmp/cache/views
#	chmod -R 777 $(DESTDIR)/opt/tizbin/xi/app/tmp/cache
	chmod +x $(DESTDIR)/opt/tizbin/script/*
	
endif


.PHONY: check_version
check_version:
	@./check_version.sh none


.PHONY: reset
reset:
	rm -rf tmp/*
	rm -rf xdecode


tgz: clean
	cd ..; tar cvzf tizbin-$(VER).tgz --exclude cscope.files --exclude cscope.out --exclude CVS --exclude .git --exclude release --exclude .svn tizbin*/
	mkdir -p release
	mv ../tizbin-$(VER).tgz release
	rm -f release/*.gpg


%.o: %.c
	$(CC) $(MCFLAGS) -c -o $@ $< 


.depend: $(SRC)
	$(CC) -M $(MCFLAGS) $(SRC) > $@


sinclude .depend
