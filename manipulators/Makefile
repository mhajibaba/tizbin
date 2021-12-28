# Makefile
#


# sub directory
SUBDIRS = www mfbc mwmail mfile mpaltalk mwebymsg


# To make it visible
export CC CCPP ROOT_DIR CFLAGS LDFLAGS INCLUDE_DIR

all: subdir 


subdir:
	@for dir in $(SUBDIRS) ; \
	   do $(MAKE) -C $$dir || exit 1; \
	 done

clean:
	@for dir in $(SUBDIRS) ; do $(MAKE) -C $$dir clean || exit 1; done
	rm -f *~ .depend *.expand core/*~


install:
	@for dir in $(SUBDIRS) ; do $(MAKE) -C $$dir install || exit 1; done


.depend: $(SRC)
#	$(CC) -M $(CFLAGS) $(SRC) > $@


sinclude .depend
