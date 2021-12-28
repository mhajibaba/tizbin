# Makefile
#
#


# sub directory
SUBDIRS = pcap pol rltm rltm_pol ca

# log captures flags
CFLAGS += -DLOG_COMPONENT=-2

# sec file
SRC = capture.c

# To make it visible
export CC CCPP ROOT_DIR CFLAGS LDFLAGS INCLUDE_DIR

all: subdir libtizbin_capt.a


libtizbin_capt.a: $(SRC:.c=.o)
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
