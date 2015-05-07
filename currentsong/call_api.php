<?php
// Votre RadioUID
$radiouid = "8913381b-377c-4165-a8cd-1f70c640dd01";
// Votre APIKey
$apikey = "f7d8b48a-9257-4c9c-98e6-43ffb270c970";
// R�cup�ration des pochettes
$cover = "yes"; // "yes" ou "no"



/* --------------------------------- */
/*   #### ! NE PAS MODIFIER ! ####   */
/* --------------------------------- */

// Fichier de cache local
$cache = 'cache_api.txt';
$cacheCall = 'cache_callapi.txt';
$date = "-1";

if(strtoupper(substr(PHP_OS, 0, 3)) != 'WIN') {
    // Test des droits d'acc�s
    if (substr(decoct(@fileperms($cacheCall)), 3, 3) != "777" && substr(decoct(@fileperms($cacheCall)), 3, 3) != "644" && !@chmod($cacheCall, 0777)) {
        echo 'Erreur ! Vous devez autoriser en écriture le fichier cache_callapi.txt';
        exit;
    }
    if (substr(decoct(@fileperms($cache)), 3, 3) != "777" && substr(decoct(@fileperms($cache)), 3, 3) != "644" && !@chmod($cache, 0777)) {
        echo 'Erreur ! Vous devez autoriser en écriture le fichier cache_api.txt';
        exit;
    }
}
if($lines = file($cacheCall)){$date = (isset($lines[1]) ? $lines[1] : '-1'); $time = $lines[0]; $expire = time() - $time;}
else{$expire = time() - 1;}
if(!(@file_exists($cache) && $date > $expire && file_get_contents($cache) != "")){
	@file_put_contents($cacheCall, "200"."\n".time());
	$context = stream_context_create(array('http' => array('timeout' => 30)));
	touch($cache);
	$data = @file_get_contents('http://api.radionomy.com/currentsong.cfm?radiouid='.$radiouid.'&callmeback=yes&type=xml'.(!empty($apikey) ? '&apikey='.$apikey : '').''.(!empty($cover) ? '&cover='.$cover : '').'',0, $context);
	if($data) {
        @file_put_contents($cache, $data);
        $data = @simplexml_load_file($cache);
        $expireNext = ($data->track->callmeback / 1000);
        if($expireNext < 10) $expireNext = 60;
        @file_put_contents($cacheCall, $expireNext."\n".time());
    }
}
echo @json_encode(simplexml_load_file($cache));
?>