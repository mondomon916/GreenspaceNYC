<?php
$handle = fopen("http://torsobaby.com/greenspacenyc/p/nyc_data_sets/bobabbl.txt", "r");
$file = fopen("result.txt", "w");
$lines = count(file($handle));
set_time_limit(0);
ini_set("memory_limit","15M");

while (($data = fgetcsv($handle, $lines, ",")) !== FALSE) {
	if ($data[21] == "vacant" || $data[21] == "V") {
		foreach($data as $key => $value) {
			fwrite($file, $value. ",");
		}
		fputs($file, "\n");
	}
}

fclose($handle);
?>
