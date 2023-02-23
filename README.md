# A set of Apache2 Rewrite rules to block fake google and bing bots.

A short script / set of Rewrite rules for Apache 2.4 and higher to block fake goole and bing bots.

We noticed a lot of request where the usere agent suggest to be a google bot or bing bot 
but there are not from google or bing.

A lot of sites opens content for google and bing bots to be visible in net. 
But fake bots use this to request your content that should be index but not accessible.

Run the gen.php from time to time (cron) to keep you ruleset up-to-date. Restart apache2 with "apachectl graceful"

This ruleset is from end of 2022 and do not use it - please run the php script to generate an up-to-date list:

```
<?php

$x= array(
        "Googlebot"        => "https://developers.google.com/search/apis/ipranges/googlebot.json",
        "Bingbot"  => "https://www.bing.com/toolbox/bingbot.json"
        );

$fp=fopen("blockfakebots.conf","w");

foreach($x as $regex => $url){

        if( empty($x = json_decode(file_get_contents($url)))) die("Cannot load IP-List for $url");

        fprintf($fp,"RewriteCond %%{HTTP_USER_AGENT} ^(.*)%s(.*)$ [NC] \n",$regex);
        foreach($x->prefixes as $val){ if(isset($val->ipv4Prefix)){ fprintf($fp,"RewriteCond expr \"! -R '%s'\" \n",$val->ipv4Prefix); } }
        #foreach($x->prefixes as $val){ if(isset($val->ipv4Prefix)){ fprintf($fp,"RewriteCond expr \"! %%{REMOTE_ADDR} -ipmatch '%s'\"\n",$val->ipv4Prefix); } }
        fprintf($fp,"RewriteRule ^ - [R=403,L] \n\n\n");
}

fclose($fp);
?>

```

This will generate a list like this:

```
RewriteCond %{HTTP_USER_AGENT} ^(.*)Googlebot(.*)$ [NC]
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.100.182.96/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.101.50.144/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.118.254.0/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.118.66.0/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.126.178.96/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.146.150.144/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.147.110.144/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.151.74.144/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.152.50.64/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.154.114.144/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.155.98.32/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.165.18.176/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.175.160.64/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.176.130.16/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.64.82.64/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.65.242.112/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.80.50.80/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.88.194.0/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.89.10.80/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.89.198.80/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '34.96.162.48/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '35.247.243.240/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.64.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.64.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.64.160/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.64.192/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.64.224/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.64.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.64.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.64.96/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.65.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.65.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.65.160/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.65.192/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.65.224/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.65.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.65.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.65.96/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.66.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.66.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.66.192/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.66.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.66.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.68.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.68.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.68.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.69.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.69.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.69.160/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.69.192/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.69.224/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.69.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.69.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.69.96/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.70.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.70.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.70.160/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.70.192/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.70.224/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.70.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.70.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.70.96/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.71.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.71.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.71.160/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.71.192/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.71.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.71.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.71.96/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.72.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.72.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.72.160/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.72.192/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.72.224/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.72.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.72.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.72.96/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.73.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.73.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.73.160/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.73.192/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.73.224/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.73.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.73.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.73.96/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.74.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.74.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.74.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.74.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.74.96/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.75.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.75.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.75.160/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.75.192/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.75.224/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.75.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.75.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.75.96/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.76.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.76.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.76.160/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.76.192/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.76.224/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.76.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.76.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.76.96/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.77.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.77.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.77.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.77.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.77.96/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.79.0/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.79.128/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.79.160/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.79.192/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.79.224/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.79.32/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.79.64/27'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '66.249.79.96/27'"
RewriteRule ^ - [R=403,L]


RewriteCond %{HTTP_USER_AGENT} ^(.*)Bingbot(.*)$ [NC]
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '157.55.39.0/24'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '207.46.13.0/24'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '40.77.167.0/24'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '13.66.139.0/24'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '13.66.144.0/24'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '52.167.144.0/24'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '13.67.10.16/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '13.69.66.240/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '13.71.172.224/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '139.217.52.0/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '191.233.204.224/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '20.36.108.32/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '20.43.120.16/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '40.79.131.208/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '40.79.186.176/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '52.231.148.0/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '20.79.107.240/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '51.105.67.0/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '20.125.163.80/28'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '40.77.188.0/22'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '65.55.210.0/24'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '199.30.24.0/23'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '40.77.202.0/24'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '40.77.139.0/25'"
RewriteCond expr "! %{REMOTE_ADDR} -ipmatch '20.74.197.0/28'"
RewriteRule ^ - [R=403,L]


```
