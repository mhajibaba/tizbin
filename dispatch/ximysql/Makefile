# Makefile
#
#

# dispatch name
DISP_NAME = disp_ximysql


# dispatch library (.so)
DISP_SO = $(DISP_NAME).so
DISP_SO_LIST = $(DISP_NAME)_list.so

# sub directory
SUBDIRS = 

# src file
SRC = ximysql.c

# compilation
CFLAGS += $(shell mysql_config --cflags)
LDFLAGS += $(shell mysql_config --libs)

# To make it visible
export CC CCPP ROOT_DIR CFLAGS LDFLAGS INCLUDE_DIR


all: subdir $(DISP_SO) $(DISP_SO_LIST)


$(DISP_SO): $(SRC:.c=.o)
	$(CC) $(CFLAGS) -shared -Wl,-soname,$@ -o $@ $(SRC:.c=.o) $(LDFLAGS)

$(DISP_SO_LIST): ximysql_list.o
	$(CC) $(CFLAGS) -shared -Wl,-soname,$@ -o $@ ximysql_list.o $(LDFLAGS)


subdir:
	@for dir in $(SUBDIRS) ; \
	   do $(MAKE) -C $$dir || exit 1; \
	 done \


clean:
	@for dir in $(SUBDIRS) ; do $(MAKE) -C $$dir clean || exit 1; done
	rm -f *.o *.so *~ include/*~ .depend *.expand


.depend: $(SRC)
	$(CC) -M $(CFLAGS) $(SRC) > $@

ximysql_list.o: $(SRC:.c=.o)
	$(CC) $(CFLAGS) -DDISP_CLI_FILE_LIST=1 -c -o $@ $(SRC)


sinclude .depend
