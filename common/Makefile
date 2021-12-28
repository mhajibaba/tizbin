# Makefile
#
#


# sub directory
SUBDIRS = 

# log core flags
CFLAGS += -DLOG_COMPONENT=-1

# src file
SRC = dmemory.c log.c flow.c dis_mod.c config_param.c field_types.c prot.c \
	packet.c fthread.c grp_flows.c grp_rule.c strutil.c embedded.c link.c \
	dnsdb.c geoiploc.c fileformat.c genfun.c


# To make it visible
export CC CCPP ROOT_DIR CFLAGS LDFLAGS INCLUDE_DIR


all: subdir libtizbin_core.a


libtizbin_core.a: $(SRC:.c=.o)
	ar rcs $@ $(SRC:.c=.o)
	ranlib $@


subdir:
	@for dir in $(SUBDIRS) ; \
	   do $(MAKE) -C $$dir || exit 1; \
	 done \

clean:
	@for dir in $(SUBDIRS) ; do $(MAKE) -C $$dir clean || exit 1; done
	rm -f *.o *.so *.a *~ include/*~ .depend *.expand


.depend: $(SRC)
	$(CC) -M $(CFLAGS) $(SRC) > $@


sinclude .depend
