<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Greenspacenyc - by Greenspacenyc
 *
 * @package		Greenspacenyc
 * @author		Greenspacenyc Dev Team
 * @copyright	Copyright (c) 2003 - 2010, Greenspacenyc
 * @link		http://www.greenspacenyc.org
 * @since		Version 1.0
 * @filesource
 */

// --------------------------------------------------------------------

/**
 * Greenspacenyc parse_csv class
 *
 * @package		Greenspacenyc
 * @subpackage	Modules
 * @category	Modules
 * @author		Greenspacenyc Dev Team
 * @link		http://www.greenspacenyc.org
 */

class parse_csv_boro
{ 
	var $handle; 
	var $file; 
	var $line;
	var	$inputurl;
	var $outputurl;
	
	/**
	 * Constructor
	 */
	function parse_csv_boro($inputurl='', $outputurl='', $lines='', $handle='', $file='') 
	{ 
		$this->inputurl=$inputurl;
		$this->outputurl=$outputurl;
		$this->line=$lines;
		$this->handle=$handle;
		$this->file=$file;
	}
	
	/**
	 * Parse 
	 */
	function parse($in, $out) 
	{ 
	set_time_limit(0);
	ini_set('memory_limit','16M');
	
	$this->inputurl=$in;
	$this->outputurl=$out;
	$this->handle = fopen($this->inputurl, 'r');
	$this->file = fopen($this->outputurl, 'w');
	$this->line = count(file($this->handle));
	
		while (($data = fgetcsv($this->handle, $this->line, ",")) !== FALSE) {
			/*if ($data[21] == "vacant" || $data[21] == "V") {
				foreach($data as $key => $value) {
					fwrite($this->file, $value. ",");
				}
			fputs($this->file, "\n");
			}*/
			
			if ($data[0] == 1 && $data[21] == " ") {
				foreach($data as $key => $value) {
					fwrite($this->file, $value. ",");
				}
			fputs($this->file, "\n");
			}
			
		}
	} 
	
	/**
	 * Parse_boro
	 */
	/*function parse_boro($in, $out, $boro="1") 
	{ 
	set_time_limit(0);
	ini_set('memory_limit','16M');
	
	$this->inputurl=$in;
	$this->outputurl=$out;
	$this->boronumb=$boro;
	$this->handle = fopen($this->inputurl, 'r');
	$this->file = fopen($this->outputurl, 'w');
	$this->line = count(file($this->handle));
	
	$data = fgetcsv($this->handle, $this->line, ",");
	var_dump($data[0]);
	var_dump($this->line);
		//print the title row
		if($this->line == 0){
			foreach($data as $key => $value) {
					fwrite($this->file, $value. ",");
				}
			fputs($this->file, "\n");
		}
		
		//print the remaining data rows
		while (($data = fgetcsv($this->handle, $this->line, ",")) !== FALSE) {
			//boro key: 1-manhattan, 2-bronx 3-brooklyn 4-queens 5-staten island
			if ($data[1] == $this->boronumb) {
				foreach($data as $key => $value) {
					fwrite($this->file, $value. ",");
				}
			fputs($this->file, "\n");
			}
		}
	} */
	
	/**
	 * Parse_boro
	 */
	function parse_boro_st($in, $out, $boro="1") 
	{ 
	set_time_limit(0);
	ini_set('memory_limit','16M');
	
	$this->inputurl=$in;
	$this->outputurl=$out;
	$this->handle = fopen($this->inputurl, 'r');
	$this->file = fopen($this->outputurl, 'w');
	$this->line = count(file($this->handle));
	
		while (($data = fgetcsv($this->handle, $this->line, chr(32))) !== FALSE) {
				foreach($data as $key => $value) {
					fwrite($this->file, $value. ",");
				}
			fputs($this->file, "\n");
		}
	} 
	
	function parse_boro_csv($in, $out)
	{
		set_time_limit(0);
		ini_set('memory_limit','16M');
		
		$this->inputurl=$in;
		$this->outputurl=$out;
		$this->handle = fopen($this->inputurl, 'r');
		$this->file = fopen($this->outputurl, 'w');
		$this->line = count(file($this->handle));
		
	}
	
	/**
	 * Parse_boro
	 */
	/*function parse_import_boro($in, $boro="1") 
	{ 
	set_time_limit(0);
	ini_set('memory_limit','16M');
	
	$this->inputurl=$in;
	//$this->outputurl=$out;
	$this->boronumb=$boro;
	$this->handle = fopen($this->inputurl, 'r');
	//$this->file = fopen($this->outputurl, 'w');
	$this->line = count(file($this->handle));
	
	$data = fgetcsv($this->handle, $this->line, ",");
		
		//print the title row
		if($this->line == 0){
			//do nothing
		}
	$my_array = array('bldg_boro'=>'','bldg_block'=>'','bldg_lot'=>'','condo_flag'=>'','bldg_vacant'=>'');
		//print the remaining data rows
		while (($data = fgetcsv($this->handle, $this->line, ",")) !== FALSE) {
			//boro key: 1-manhattan, 2-bronx 3-brooklyn 4-queens 5-staten island
			
		}
	} */
	
	/**
	 * Error messages 
	 */
	function error($error) 
	{ 
		echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>parse_csv Error</b><br>$error</div></center>"; 
		die; 
	} 
}//End class cURL

//Usage
//$p_csv = new parse_csv(); 
//$p_csv->parse('http://www.example.com'); 

//End file .p/parse_csv/parse_csv.php 
?> 