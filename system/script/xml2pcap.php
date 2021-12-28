#!/usr/bin/php -q
<?php
  /*
  */

if ($argc != 3) {
    echo "Usage:  ".$argv[0]." <xml_file> <output_file>\n\n";
    die();
}
$xml = simplexml_load_file($argv[1]);
if ($xml === FALSE) {
    echo "Error: ".$argv[1]." isn't a XML file\n";
    die();
}

$filtr = null;

foreach($xml->flow as $flow) {
    foreach($flow->frame as $frame) {
        if ($frame->frm_type == 'tcp') {
            foreach($frame as $prop) {
                if ($prop->name == 'tcp.srcport') {
                    $src_tcp_port = $prop->value;
                }
                else if ($prop->name == 'tcp.dstport') {
                    $dst_tcp_port = $prop->value;
                }
            }
        }
        else if ($frame->frm_type == 'udp') {
            foreach($frame as $prop) {
                if ($prop->name == 'udp.srcport') {
                    $src_udp_port = $prop->value;
                }
                else if ($prop->name == 'udp.dstport') {
                    $dst_udp_port = $prop->value;
                }
            }
        }
        else if ($frame->frm_type == 'ip') {
            foreach($frame as $prop) {
                if ($prop->name == 'ip.src') {
                    $src_ip = $prop->value;
                }
                else if ($prop->name == 'ip.dst') {
                    $dst_ip = $prop->value;
                }
            }
        }
        else if ($frame->frm_type == 'ipv6') {
            foreach($frame as $prop) {
                if ($prop->name == 'ipv6.src') {
                    $src_ipv6 = $prop->value;
                }
                else if ($prop->name == 'ipv6.dst') {
                    $dst_ipv6 = $prop->value;
                }
            }
        }
        else if ($frame->frm_type == 'pcapf') {
            foreach($frame as $prop) {
                if ($prop->name == 'pcapf.file') {
                    $pcap_file = $prop->value;
                }
            }
        }
        else if ($frame->frm_type == 'pol') {
            foreach($frame as $prop) {
                if ($prop->name == 'pol.file') {
                    $pcap_file = str_replace("/decode/", "/raw/", $prop->value);
                    if (!file_exists($pcap_file))
                        $pcap_file = str_replace("/raw/", "/fault/", $prop->value);
                }
            }
        }
    }
    if ($filtr != null)
        $filtr .= " or ";
    if (isset($src_tcp_port)) {
        if (isset($src_ip)) {
            $filtr .= "(ip.addr==".$src_ip." and ip.addr==".$dst_ip." and tcp.port==".$src_tcp_port." and tcp.port==".$dst_tcp_port.")";
        }
        else {
            $filtr .= "(tcp.port==".$src_tcp_port." and tcp.port==".$dst_tcp_port.")";
        }
    }
    else if (isset($src_udp_port)) {
        if (isset($src_ip)) {
            $filtr .= "(ip.addr==".$src_ip." and ip.addr==".$dst_ip." and udp.port==".$src_udp_port." and udp.port==".$dst_udp_port.")";
        }
        else {
            $filtr .= "(udp.port==".$src_udp_port." and udp.port==".$dst_udp_port.")";
        }
    }
    else
        $filtr .= "(ip.addr==".$src_ip." and ip.addr==".$dst_ip.")";
    unset($src_tcp_port);
    unset($src_udp_port);
}

$cmd = "tshark -n -r \"".$pcap_file."\" -R \"".$filtr."\" -w ".$argv[2];

system($cmd);
echo "Pcap file: ".$pcap_file."\n";
echo "Filter: ".$filtr."\n";
echo "Cmd line: ".$cmd."\n";

?>
