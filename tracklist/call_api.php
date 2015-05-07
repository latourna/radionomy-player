<?php
// Votre RadioUID
$radiouid = "8913381b-377c-4165-a8cd-1f70c640dd01";
// Votre APIKey
$apikey = "f7d8b48a-9257-4c9c-98e6-43ffb270c970";
// Récupération des pochettes
$cover = "yes"; // "yes" ou "no"
// Nombre de résultats à récupérer
$amount = "5";
// Type de retour
$type = "xml"; // "xml" ou "string"

/* --------------------------------- */
/*   #### ! NE PAS MODIFIER ! ####   */
/* --------------------------------- */
$cache = 'tracklist/cache_api.txt';

$expire = time() - 310;
if(!(@file_exists($cache) && @filemtime($cache) > $expire)) {
	$context = stream_context_create(array('http' => array('timeout' => 30)));
	touch($cache);
	$xml = @file_get_contents('http://api.radionomy.com/tracklist.cfm?radiouid='.$radiouid.''.(isset($apikey) ? '&apikey='.$apikey : '').(isset($amount) ? '&amount='.$amount : '').(isset($cover) ? '&cover='.$cover : '').(isset($type) ? '&type='.$type : ''),0, $context);
	if($xml)
    @file_put_contents($cache, $xml);
}
echo @json_encode(simplexml_load_file($cache));
?>