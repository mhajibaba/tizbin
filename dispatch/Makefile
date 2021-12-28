# Makefile
#
#


# sub directory
SUBDIRS = none cli lite pcap2wav capostgres ximysql

# log dispatcer flags
CFLAGS += -DLOG_COMPONENT=-3

# src file
SRC = dispatch.c disp_manipula.c gearth.c

# To make it visible
export CC CCPP ROOT_DIR CFLAGS LDFLAGS INCLUDE_DIR


all: subdir libtizbin_dispatch.a


libtizbin_dispatch.a: $(SRC:.c=.o)
	ar rcs $@ $(SRC:.c=.o)
	ranlib $@


subdir:
	@for dir in $(SUBDIRS) ; \
	   do $(MAKE) -C $$dir || exit 1; \
	 done \

clean:
	@for dir in $(SUBDIRS) ; do $(MAKE) -C $$dir clean || exit 1; done
	rm -f *.o *.so *.a *~ include/*~ .depend *.expand


.depend: $(SRC) Makefile
	$(CC) -M $(CFLAGS) $(SRC) > .depend


sinclude .depend
