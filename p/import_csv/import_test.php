<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');
echo('hello');
require_once('import_csv.php');

$my_import = new Import_csv();
//$in = 'http://www.greenspacenyc.org/p/parse_csv/addr_sample_set.txt';
//$in = 'http://www.greenspacenyc.org/p/parse_csv/addr_result_si.txt';
//$in = 'http://www.greenspacenyc.org/p/parse_csv/result.txt';
//$in = 'http://www.greenspacenyc.org/p/parse_csv/dob_complaints_sample.txt';
//$in = 'http://www.greenspacenyc.org/p/parse_csv/DOB_Complaints201009_001.csv';
$in = 'http://www.greenspacenyc.org/p/parse_csv/si_bbl_result.txt';
//$in = 'http://www.greenspacenyc.org/p/nyc_data_sets/bobabbl.txt';
$out = 'addr_sample_result.txt';
//$my_import->import_bbl($in, $out);
//$my_import->import_addr($in, $out);
//$my_import->import_dob($in, $out);
$my_import->import_bbl_new($in, $out);
var_dump($my_import);

?>