<?php

$x= array(
        "[G|g]oogle"    => "https://developers.google.com/search/apis/ipranges/googlebot.json",
        "[B|b]ing"      => "https://www.bing.com/toolbox/bingbot.json"
        );

$fp=fopen("blockfakebots.conf","w");

foreach($x as $regex => $url){

        if( empty($x = json_decode(file_get_contents($url)))) die("Cannot load IP-List for $url");

        fprintf($fp,"RewriteCond %%{HTTP_USER_AGENT} ^(.*)%s(.*)$ \n",$regex);
        foreach($x->prefixes as $val){ if(isset($val->ipv4Prefix)){ fprintf($fp,"RewriteCond expr \"! -R '%s'\" \n",$val->ipv4Prefix); } }
        #foreach($x->prefixes as $val){ if(isset($val->ipv4Prefix)){ fprintf($fp,"RewriteCond expr \"! %%{REMOTE_ADDR} -ipmatch '%s'\"\n",$val->ipv4Prefix); } }
        fprintf($fp,"RewriteRule ^ - [R=403,L] \n\n\n");
}

fclose($fp);
?>
