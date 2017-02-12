<?php

$regions = array("de", "fr", "pt", "ie", "es", "pl", "cz", "nl", "fi", "lt", "be", "it", "uk");
$blocksizes = array("1", "4", "8", "16", "32", "64", "128", "256");

// You have to get OWN Credentials for the API: https://api.ovh.com/createToken/index.cgi?GET=/*
// Fill out the following with your own Credentials and Information

$AK = 'sjdfhhfhfihihdfh';                     // Application Key
$AS = 'fshdfhiusehfewhiehfwhfiehfowhfiw';     // Application Secret
$CK = 'fruheuhrfeuhrfeorhfeihrfhrfeoihf';     // Consumer Key
$endpoint = 'ovh-eu';
$servicename = 'ns3012345.ip-130-70-200.eu';  // A Server which can book IP Adresses within your account
$organisationID = 'RIPE_34567';               // An added Organisation within your account

$search  = array('"', '{', '}', ':'); 
$replace = array('', '"', '"', '');

$curContent = '<table border=0 width=100%><tr><td width=100% align=center>OVH IP Subnet availability of all sizes and all countries<br>&nbsp;<br><table border=1>';

$conn = curl_init(); 
$request = curl_init(); 

foreach($regions AS $region) {
	
	$curContent = $curContent.'<tr><td width=50px height=50px align=center valign=middle>'.$region.'</td>';

	foreach($blocksizes AS $blocksize) {

		curl_setopt($conn, CURLOPT_URL, "https://eu.api.ovh.com/1.0/auth/time"); 
		curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1); 
		$timestamp = curl_exec($conn); 
 
		$url = 'https://eu.api.ovh.com/1.0/order/dedicated/server/'.$servicename.'/ip?country='.$region.'&organisationId='.$organisationID.'&blockSize='.$blocksize.'&type=failover';
		$str = $AS.'+'.$CK.'+GET+'.$url.'++'.$timestamp;
		$signature = "$1$".sha1($str);

		curl_setopt($request, CURLOPT_HTTPHEADER, array(
			'X-Ovh-Application:'.$AK,
			'X-Ovh-Timestamp:'.$timestamp,
			'X-Ovh-Signature:'.$signature,
			'X-Ovh-Consumer:'.$CK
		));
		curl_setopt($request, CURLOPT_URL, $url); 
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); 
		$output2 = curl_exec($request); 

		
		$pos = strpos($output2, 'upto');
		if ($pos === false) {
			$curContent = $curContent.'<td align=center valign=middle bgcolor=#FFB1B1 style=background-color:#FFB1B1 width=50px height=50px><a title='.str_replace($search,$replace,$output2).'>'.$blocksize."</td>\n";
		} else {
			$curContent = $curContent.'<td align=center valign=middle bgcolor=#BDF6BE style=background-color:#BDF6BE width=50px height=50px><a title='.str_replace($search,$replace,$output2).'>'.$blocksize."</td>\n";
		}

	}	

	$curContent = $curContent.'</tr>';

}

curl_close($request);  
curl_close($conn); 

$curContent = $curContent.'</table></td></tr></table>';
echo $curContent;

?>

