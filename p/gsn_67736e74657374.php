<?php 

echo('hello');
require_once('curl/curl.php');

echo('hello123');
$data_mine = "";
$cc = new cURL();
//$data_mine = $cc->get('http://elev.at//lift?text=http://www.nyc.gov/html/dcp/download/biggapps/DCP_pad_001.zip');

$data_mine = $cc->get('http://elev.at//lift?text=http://www.nyc.gov/html/dcp/downloads/data/DCAS_IPIS_001_15SEPT2010.csv');

var_dump($data_mine);


/*
$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,'http://elev.at//lift?text=http://www.nyc.gov/html/dcp/download/biggapps/DCP_nyc_facilities_text_001.zip&zipentry=Agoper.txt');
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);

if (empty($buffer))
{
    print "Sorry, example.com are a bunch of poopy-heads.<p>";
}
else
{
    print $buffer;
}*/


//Usage
//$cc = new cURL(); 
//$cc->get('http://www.example.com'); 
//$cc->post('http://www.example.com','foo=bar');

//End file .p/gsn_67736e74657374.php 
?> 