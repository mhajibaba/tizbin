# Makefile
#


# sub directory
SUBDIRS =  pcapf eth ip ipv6 tcp tcp_grbg udp udp_grbg http pop imap smtp
SUBDIRS += ppp pol sdp ftp dns icmp ipp pjl mms sll tftp vlan l2tp pppoe nntp
SUBDIRS += ieee80211 llc fbwchat telnet webmail httpfd rtp sip rtcp irc msn paltalk
SUBDIRS += arp paltalk_express radiotap icmpv6 ppi syslog prism null chdlc webymsg
SUBDIRS += wa mgcp dns_ca tcp_ca udp_ca ipsec ipsec_ca mpls gtp gre ssl

# src file
SRC = in_cksum.c http.c sdp.c link.c
CFLAGS_CORE = $(CFLAGS)

# To make it visible
export CC CCPP ROOT_DIR CFLAGS LDFLAGS INCLUDE_DIR

# log parametrization for core
CFLAGS_CORE += -DLOG_COMPONENT=-1

all: subdir libtizbin_dissector.a


libtizbin_dissector.a: $(SRC:.c=.o)
	ar rcs $@ $(SRC:.c=.o)
	ranlib $@


subdir:
	@for dir in $(SUBDIRS) ; \
	   do $(MAKE) -C $$dir || exit 1; \
	 done \

clean:
	@for dir in $(SUBDIRS); do $(MAKE) -C $$dir clean || exit 1;rm -f $$dir/dis_log.c;  done
	rm -f *.o *.so *.a *~ include/*~ .depend *.expand


.depend: $(SRC) dis_log.c
	@for dir in $(SUBDIRS) ; do cp -a dis_log.c $$dir/dis_log.c; done
	$(CC) -M $(CFLAGS_CORE) $(SRC) > $@


# custom to use CFLAGS_CORE
.c.o:
	$(CC) -c $< -o $@ $(CFLAGS_CORE)


ifdef SRC
sinclude .depend
endif
