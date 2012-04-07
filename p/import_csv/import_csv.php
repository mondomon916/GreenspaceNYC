<?php

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

//included files
include 'GSNLogin.php'; //include the expression engine database login

class Import_csv
{
	/**
	 * Constructor
	 */
	function Import_csv($inputurl='', $outputurl='', $lines='', $handle='', $file='') 
	{ 
		$this->inputurl=$inputurl;
		$this->outputurl=$outputurl;
		$this->line=$lines;
		$this->handle=$handle;
		$this->file=$file;
	}
	
	/**
	 * Import
	 */
	function Import($in, $out)
	{
		set_time_limit(0);
		ini_set('memory_limit','16M');
		
		$this->inputurl=$in;
		$this->outputurl=$out;
		$this->handle = fopen($this->inputurl, 'r');
		$this->file = fopen($this->outputurl, 'w');
		$this->line = count(file($this->handle));
		
		$data_dump = new stdclass();
		
  		$my_count = 0;
		//loop the csv
		while (($data = fgetcsv($this->handle, $this->line, ",")) !== FALSE) 
		{
			
			$my_count++;
			var_dump('count= ' . $my_count);
			//1 starts the column names
			//2 starts the data
			if($my_count > 113130)
			{
				foreach($data as $key => $value) {
					
					//var_dump('v=' . $value);
					//var_dump('k=' . $key);
					//fwrite($this->file, $value. ",");
					
					$data_dump->boro = $data[0];
					$data_dump->block = $data[1];
					$data_dump->lot = $data[2];
					$data_dump->bin = $data[3];
					$data_dump->lhnd = $data[4];
					$data_dump->lhns = $data[5];
					$data_dump->lcontpar = $data[6];
					$data_dump->lsos = $data[7];
					$data_dump->hhnd = $data[8];
					$data_dump->hhns = $data[9];
					$data_dump->hcontpar = $data[10];
					$data_dump->hsos = $data[11];
					$data_dump->scboro = $data[12];
					$data_dump->sc5 = $data[13];
					$data_dump->sclgc = $data[14];
					$data_dump->st_name = $data[15];
					$data_dump->type = $data[16];
					$data_dump->b7sc = $data[17];
					$data_dump->vlgcs = $data[18];
					$data_dump->parity = $data[19];
					$data_dump->b10sc = $data[20];
					
				}
				//var_dump($data_dump);
				
				$test = $this->insert_record($data_dump);
				//var_dump($test);
				
			}
			
			
		}
	}
	
	function insert_record($data_dump)
	{
		
		$boro = $data_dump->boro;
		$block = $data_dump->block;
		$lot = $data_dump->lot;
		$bin = $data_dump->bin;
		$lhnd = $data_dump->lhnd;
		$lhns = $data_dump->lhns;
		$lcontpar = $data_dump->lcontpar;
		$lsos = $data_dump->lsos;
		$hhnd = $data_dump->hhnd;
		$hhns = $data_dump->hhns;
		$hcontpar = $data_dump->hcontpar;
		$hsos = $data_dump->hsos;
		$scboro = $data_dump->scboro;
		$sc5 = $data_dump->sc5;
		$sclgc = $data_dump->sclgc;
		$st_name = $data_dump->st_name;
		$type = $data_dump->type;
		$b7sc = $data_dump->b7sc;
		$vlgcs = $data_dump->vlgcs;
		$parity = $data_dump->parity;
		$b10sc = $data_dump->b10sc;
		
		//log into database
  		$mDB = new GSNLogin();
  		$DB = $mDB->GSNLogin();
  		
  		//check for dups
  		$sql = mysql_query("		
  							SELECT Addr_Id FROM exp_pad_addr
  							WHERE Addr_Boro = $boro
  							AND Addr_Block = '$block'
  							AND Addr_Lot = '$lot'
  							AND Addr_Bin = '$bin'
  							AND Addr_Lhnd = '$lhnd'
  							AND Addr_Lhns = '$lhns'
  							AND Addr_Lcontpar = '$lcontpar'
  							AND Addr_Lsos = '$lsos'
  							AND Addr_Hhnd = '$hhnd'
  							AND Addr_Hhns = '$hhns'
  							AND Addr_Hcontpar = '$hcontpar'
  							AND Addr_Hsos = '$hsos'
  							AND Addr_Scboro = '$scboro'
  							AND Addr_Sc5 = '$sc5'
  							AND Addr_Sclgc = '$sclgc'
  							AND Addr_St_Name = '$st_name'
  							AND Addr_Type = '$type'
  							AND Addr_Real_B7SC = '$b7sc'
  							AND Addr_Valid_Lgcs = '$vlgcs'
  							AND Addr_Parity = '$parity'
  							AND Addr_B10SC = '$b10sc'
  							", $DB);
  		
  		$num_rows = mysql_num_rows($sql);
  		
  		if($num_rows == 0)
  		{
  			
	  		$sql =  mysql_query("
	  								INSERT INTO exp_pad_addr
	  								(
	  									Addr_Boro
	  									,Addr_Block
	  									,Addr_Lot
	  									,Addr_Bin
	  									,Addr_Lhnd
	  									,Addr_Lhns
	  									,Addr_Lcontpar
	  									,Addr_Lsos
	  									,Addr_Hhnd
	  									,Addr_Hhns
	  									,Addr_Hcontpar
	  									,Addr_Hsos
	  									,Addr_Scboro
	  									,Addr_Sc5
	  									,Addr_Sclgc
	  									,Addr_St_Name
	  									,Addr_Type
	  									,Addr_Real_B7SC
	  									,Addr_Valid_Lgcs
	  									,Addr_Parity
	  									,Addr_B10SC
	  								) 
	  								VALUES
	  								(
	  									'$boro'
										,'$block'
										,'$lot'
										,'$bin'
										,'$lhnd'
										,'$lhns'
										,'$lcontpar'
										,'$lsos'
										,'$hhnd'
										,'$hhns'
										,'$hcontpar'
										,'$hsos'
										,'$scboro'
										,'$sc5'
										,'$sclgc'
										,'$st_name'
										,'$type'
										,'$b7sc'
										,'$vlgcs'
										,'$parity'
										,'$b10sc'
	  								)"
	  						,$DB);
  		}
  		
  		return TRUE;
	}

	function import_bbl($in, $out)
	{
		set_time_limit(0);
		ini_set('memory_limit','16M');
		
		$this->inputurl=$in;
		$this->outputurl=$out;
		$this->handle = fopen($this->inputurl, 'r');
		$this->file = fopen($this->outputurl, 'w');
		$this->line = count(file($this->handle));
		
		$data_dump = new stdclass();
		
  		$my_count = 0;
		//loop the csv
		while (($data = fgetcsv($this->handle, $this->line, ",")) !== FALSE) 
		{
			
			$my_count++;
			var_dump('count= ' . $my_count);
			if($my_count >= 0)
			{
				foreach($data as $key => $value) 
				{
					//var_dump('v=' . $value);
					//var_dump('k=' . $key);
					
					$data_dump->lo_boro = $data[0];
					$data_dump->lo_block = $data[1];
					$data_dump->lo_lot = $data[2];
					$data_dump->lo_bbl_scc = $data[3];
					$data_dump->hi_boro = $data[4];
					$data_dump->hi_block = $data[5];
					$data_dump->hi_lot = $data[6];
					$data_dump->hi_bbl_scc = $data[7];
					$data_dump->boro = $data[8];
					$data_dump->block = $data[9];
					$data_dump->lot = $data[10];
					$data_dump->bbl_scc = $data[11];
					$data_dump->bill_boro = $data[12];
					$data_dump->bill_block = $data[13];
					$data_dump->bill_lot = $data[14];
					$data_dump->bill_bbl_scc = $data[15];
					$data_dump->condo_flag = $data[16];
					$data_dump->condo_num = $data[17];
					$data_dump->coop_num = $data[18];
					$data_dump->num_bf = $data[19];
					$data_dump->num_addr = $data[20];
					$data_dump->vacant = $data[21];
					$data_dump->interior = $data[22];
				}
				$test = $this->insert_bbl($data_dump);
				//var_dump($test);
			}
		}
	}
	
	function insert_bbl($data_dump)
	{
		$lo_boro = $data_dump->lo_boro;
		$lo_block = $data_dump->lo_block;
		$lo_lot = $data_dump->lo_lot;
		$lo_bbl_scc = $data_dump->lo_bbl_scc;
		$hi_boro = $data_dump->hi_boro;
		$hi_block = $data_dump->hi_block;
		$hi_lot = $data_dump->hi_lot;
		$hi_bbl_scc = $data_dump->hi_bbl_scc;
		$boro = $data_dump->boro;
		$block = $data_dump->block;
		$lot = $data_dump->lot;
		$condo_flag = $data_dump->condo_flag;
		$bbl_scc = $data_dump->bbl_scc;
		$bill_boro = $data_dump->bill_boro;
		$bill_block = $data_dump->bill_block;
		$bill_lot = $data_dump->bill_lot;
		$condo_num = $data_dump->condo_num;
		$coop_num = $data_dump->coop_num;
		$num_bf = $data_dump->num_bf;
		$num_addr = $data_dump->num_addr;
		$vacant = $data_dump->vacant;
		$interior = $data_dump->interior;
		
		//log into database
  		$mDB = new GSNLogin();
  		$DB = $mDB->GSNLogin();
  		
  		//check for dups
		$sql = mysql_query("		
  							SELECT BBL_Id FROM exp_pad_bbl
  							WHERE BBL_Lo_Boro = $lo_boro
  							AND BBL_Lo_Block = '$lo_block'
  							AND BBL_Lo_Lot = '$lo_lot'
  							AND BBL_Lo_Bbl_Scc = '$lo_bbl_scc'
  							AND BBL_Hi_Boro = '$hi_boro'
  							AND BBL_Hi_Block = '$hi_block'
  							AND BBL_Hi_Lot = '$hi_lot'
  							AND BBL_Hi_Bbl_Scc = '$hi_bbl_scc'
  							AND BBL_Boro = '$boro'
  							AND BBL_Block = '$block'
  							AND BBL_Lot = '$lot'
  							AND BBL_Condo_Flag = '$condo_flag'
  							AND BBL_Bbl_Scc = '$bbl_scc'
  							AND BBL_Bill_Boro = '$bill_boro'
  							AND BBL_Bill_Block = '$bill_block'
  							AND BBL_Bill_Lot = '$bill_lot'
  							AND BBL_Condo_Num = '$condo_num'
  							AND BBL_Coop_Num = '$coop_num'
  							AND BBL_Num_Bf = '$num_bf'
  							AND BBL_Num_Addr = '$num_addr'
  							AND BBL_Vacant = '$vacant'
  							AND BBL_Interior = '$interior'
  							", $DB);
  		
  		$num_rows = mysql_num_rows($sql);
		
		if($num_rows == 0)
  		{
  			
	  		$sql =  mysql_query("
	  								INSERT INTO exp_pad_bbl
	  								(
	  									BBL_Lo_Boro
	  									,BBL_Lo_Block
	  									,BBL_Lo_Lot
	  									,BBL_Lo_Bbl_Scc
	  									,BBL_Hi_Boro
	  									,BBL_Hi_Block
	  									,BBL_Hi_Lot
	  									,BBL_Hi_Bbl_Scc
	  									,BBL_Boro
	  									,BBL_Block
	  									,BBL_Lot
	  									,BBL_Condo_Flag
	  									,BBL_Bbl_Scc
	  									,BBL_Bill_Boro
	  									,BBL_Bill_Block
	  									,BBL_Bill_Lot
	  									,BBL_Condo_Num
	  									,BBL_Coop_Num
	  									,BBL_Num_Bf
	  									,BBL_Num_Addr
	  									,BBL_Vacant
	  									,BBL_Interior
	  								) 
	  								VALUES
	  								(
	  									'$lo_boro'
										,'$lo_block'
										,'$lo_lot'
										,'$lo_bbl_scc'
										,'$hi_boro'
										,'$hi_block'
										,'$hi_lot'
										,'$hi_bbl_scc'
										,'$boro'
										,'$block'
										,'$lot'
										,'$condo_flag'
										,'$bbl_scc'
										,'$bill_boro'
										,'$bill_block'
										,'$bill_lot'
										,'$condo_num'
										,'$coop_num'
										,'$num_bf'
										,'$num_addr'
										,'$vacant'
										,'$interior'
	  								)"
	  						,$DB);
  		}
  		
  		return TRUE;
		
	}
	
	function import_bbl_new($in, $out)
	{
		set_time_limit(0);
		ini_set('memory_limit','16M');
		
		$this->inputurl=$in;
		$this->outputurl=$out;
		$this->handle = fopen($this->inputurl, 'r');
		$this->file = fopen($this->outputurl, 'w');
		$this->line = count(file($this->handle));
		
		$data_dump = new stdclass();
		
  		$my_count = 0;
		//loop the csv
		while (($data = fgetcsv($this->handle, $this->line, ",")) !== FALSE) 
		{
			
			$my_count++;
			var_dump('count= ' . $my_count);
			if($my_count > 1)
			{
				foreach($data as $key => $value) 
				{
					//var_dump('v=' . $value);
					//var_dump('k=' . $key);
					
					$data_dump->lo_boro = $data[0];
					$data_dump->lo_block = $data[1];
					$data_dump->lo_lot = $data[2];
					$data_dump->lo_bbl_scc = $data[3];
					$data_dump->hi_boro = $data[4];
					$data_dump->hi_block = $data[5];
					$data_dump->hi_lot = $data[6];
					$data_dump->hi_bbl_scc = $data[7];
					$data_dump->boro = $data[8];
					$data_dump->block = $data[9];
					$data_dump->lot = $data[10];
					$data_dump->bbl_scc = $data[11];
					$data_dump->bill_boro = $data[12];
					$data_dump->bill_block = $data[13];
					$data_dump->bill_lot = $data[14];
					$data_dump->bill_bbl_scc = $data[15];
					$data_dump->condo_flag = $data[16];
					$data_dump->condo_num = $data[17];
					$data_dump->coop_num = $data[18];
					$data_dump->num_bf = $data[19];
					$data_dump->num_addr = $data[20];
					$data_dump->vacant = $data[21];
					$data_dump->interior = $data[22];
				}
				
				//var_dump($data_dump);
				
				$test = $this->insert_bbl_new($data_dump);
				//var_dump($test);
			}
		}
	}
	
	function insert_bbl_new($data_dump)
	{
		$lo_boro = $data_dump->lo_boro;
		$lo_block = $data_dump->lo_block;
		$lo_lot = $data_dump->lo_lot;
		$lo_bbl_scc = $data_dump->lo_bbl_scc;
		$hi_boro = $data_dump->hi_boro;
		$hi_block = $data_dump->hi_block;
		$hi_lot = $data_dump->hi_lot;
		$hi_bbl_scc = $data_dump->hi_bbl_scc;
		$boro = $data_dump->boro;
		$block = $data_dump->block;
		$lot = $data_dump->lot;
		$condo_flag = $data_dump->condo_flag;
		$bbl_scc = $data_dump->bbl_scc;
		$bill_boro = $data_dump->bill_boro;
		$bill_block = $data_dump->bill_block;
		$bill_lot = $data_dump->bill_lot;
		$condo_num = $data_dump->condo_num;
		$coop_num = $data_dump->coop_num;
		$num_bf = $data_dump->num_bf;
		$num_addr = $data_dump->num_addr;
		$vacant = $data_dump->vacant;
		$interior = $data_dump->interior;
		
		//log into database
  		$mDB = new GSNLogin();
  		$DB = $mDB->GSNLogin();
  		
  		//check for dups
		$sql = mysql_query("		
  							SELECT bbl_id 
  							FROM exp_gsn_bbl
  							WHERE loboro = $lo_boro
  							AND loblock = '$lo_block'
  							AND lolot = '$lo_lot'
  							AND lobblscc = '$lo_bbl_scc'
  							AND hiboro = '$hi_boro'
  							AND hiblock = '$hi_block'
  							AND hilot = '$hi_lot'
  							AND hibblscc = '$hi_bbl_scc'
  							AND boro = '$boro'
  							AND block = '$block'
  							AND lot = '$lot'
  							AND condoflag = '$condo_flag'
  							AND bblscc = '$bbl_scc'
  							AND billboro = '$bill_boro'
  							AND billblock = '$bill_block'
  							AND billlot = '$bill_lot'
  							AND condonum = '$condo_num'
  							AND coopnum = '$coop_num'
  							AND numbf = '$num_bf'
  							AND numaddr = '$num_addr'
  							AND vacant = '$vacant'
  							AND interior = '$interior'
  							", $DB);
  		
  		$num_rows = mysql_num_rows($sql);
		
		if($num_rows == 0)
  		{
  			
  			//get the addr_id
  			$sql = mysql_query("
  									SELECT addr_id
  									FROM exp_gsn_addr
  									WHERE boro = '$boro'
  									AND block = '$block'
  									AND lot = '$lot'
  									
  							");
  			
  			$test = mysql_fetch_array($sql);
  			
  			//var_dump($test['addr_id']);
  			
  			$a_id = $test[0];
  			
	  		$sql =  mysql_query("
	  								INSERT INTO exp_gsn_bbl
	  								(
	  									addr_id
	  									,loboro
	  									,loblock
	  									,lolot
	  									,lobblscc
	  									,hiboro
	  									,hiblock
	  									,hilot
	  									,hibblscc
	  									,boro
	  									,block
	  									,lot
	  									,condoflag
	  									,bblscc
	  									,billboro
	  									,billblock
	  									,billlot
	  									,condonum
	  									,coopnum
	  									,numbf
	  									,numaddr
	  									,vacant
	  									,interior
	  								) 
	  								VALUES
	  								(
	  									'$a_id'
	  									,'$lo_boro'
										,'$lo_block'
										,'$lo_lot'
										,'$lo_bbl_scc'
										,'$hi_boro'
										,'$hi_block'
										,'$hi_lot'
										,'$hi_bbl_scc'
										,'$boro'
										,'$block'
										,'$lot'
										,'$condo_flag'
										,'$bbl_scc'
										,'$bill_boro'
										,'$bill_block'
										,'$bill_lot'
										,'$condo_num'
										,'$coop_num'
										,'$num_bf'
										,'$num_addr'
										,'$vacant'
										,'$interior'
	  								)"
	  						,$DB);
  		}
  		
  		return TRUE;
		
	}
	
	function import_dob($in, $out)
	{
		set_time_limit(0);
		ini_set('memory_limit','16M');
		
		$this->inputurl=$in;
		$this->outputurl=$out;
		$this->handle = fopen($this->inputurl, 'r');
		$this->file = fopen($this->outputurl, 'w');
		$this->line = count(file($this->handle));
		
		$data_dump = new stdclass();
		
  		$my_count = 0;
		
		while (($data = fgetcsv($this->handle, $this->line, chr(9))) !== FALSE) {
			//var_dump($data);
			
			$my_count++;
			var_dump('count= ' . $my_count);
			//1 starts the column names
			//2 starts the data
			if($my_count > 1){
				foreach($data as $key => $value) {
					//fwrite($this->file, $value. ",");
					
					$data_dump->complaint_number = $data[0];
					$data_dump->complaint_reason = $data[1];
					$data_dump->complaint_category = $data[2];
					$data_dump->complaint_category_description = $data[3];
					$data_dump->priority_code = $data[4];
					$data_dump->assigned_to = $data[5];
					$data_dump->bin = $data[6];
					$data_dump->house_number = $data[7];
					$data_dump->street_name = $data[8];
					$data_dump->block = $data[9];
					$data_dump->lot = $data[10];
					$data_dump->community_board = $data[11];
					$data_dump->entry_date = $data[12];
					$data_dump->last_inspection_date = $data[13];
					$data_dump->last_disposition_date = $data[14];
					$data_dump->disposition_code = $data[15];
					$data_dump->disposition_code_description = $data[16];
					$data_dump->disposition_comments = $data[17];
					$data_dump->dob_violation_number = $data[18];
					$data_dump->ecb_violation_number = $data[19];
					$data_dump->finance_owner_name = $data[20];
					
				}
				//fputs($this->file, "\n");
				//var_dump($data_dump);
				
				//$test = $this->insert_dob($data_dump);
				$test = $this->insert_dob_new($data_dump);
			}
		}
	}
	
	function insert_dob_new($data_dump)
	{
		//var_dump($data_dump->complaint_number);
		$complaint_number = $data_dump->complaint_number;
		$complaint_reason = $this->mysql_prep($data_dump->complaint_reason);
		$complaint_category = $data_dump->complaint_category;
		$complaint_category_description = $this->mysql_prep($data_dump->complaint_category_description);
		$priority_code = $data_dump->priority_code;
		$assigned_to = $data_dump->assigned_to;
		$bin = trim($data_dump->bin);
		$house_number = $data_dump->house_number;
		$street_name = $data_dump->street_name;
		$block = trim($data_dump->block);
		$lot = trim($data_dump->lot);
		$community_board = $data_dump->community_board;
		$entry_date = $data_dump->entry_date;
		$last_inspection_date = $data_dump->last_inspection_date;
		$last_disposition_date = $data_dump->last_disposition_date;
		$disposition_code = $data_dump->disposition_code;
		$disposition_code_description = $this->mysql_prep($data_dump->disposition_code_description);
		$disposition_comments = $this->mysql_prep($data_dump->disposition_comments);
		$dob_violation_number = $data_dump->dob_violation_number;
		$ecb_violation_number = $data_dump->ecb_violation_number;
		$finance_owner_name = $this->mysql_prep($data_dump->finance_owner_name);
		
		
		//log into database
  		$mDB = new GSNLogin();
  		$DB = $mDB->GSNLogin();
  		
  		//check for dups
		$sql = mysql_query("		
  							SELECT 
  							number
  							FROM
  							exp_gsn_complaints
  							WHERE
  							number = '$data_dump->complaint_number'
  							", $DB);
  		//var_dump($sql);
  		$num_rows = mysql_num_rows($sql);
  		//var_dump($num_rows);
		
		$my_str = '';
		for($i=0; $i < strlen($bin); $i++){
			
			if(!($i % 2)) $my_str = $my_str . $bin[$i]; 
		}
		
		//var_dump('my_str len ' . strlen($my_str) . 'my_str= ' . $my_str);
		
		if($num_rows == 0)
  		{
  			var_dump('hi '.$data_dump->complaint_number);
  			
  			//var_dump('bin= ' . $bin);
  			//$tbin = $bin;
  			
  			//$boro = substr($bin, 1, 1);
  			//var_dump('rest= ' .$boro);
  			
  			//get the addr_id
  			$sql = mysql_query("
  									SELECT addr_id, block, lot, boro, bin
  									FROM exp_gsn_addr
  									WHERE bin = '$my_str'
  									LIMIT 0, 1
  									
  							", $DB);
  			 if(!$sql) echo 'error = ' . mysql_error();
  			 
  			 //var_dump($sql);
  			
  			$test = mysql_fetch_array($sql);
  			
  			//var_dump($test);
  			
  			$a_id = $test['addr_id'];
  			
  			//var_dump($a_id);
  			
  			//return false;
  			
  			$sql =  mysql_query("
	  								INSERT INTO exp_gsn_complaints
	  								(
	  									number
	  									,reason
	  									,category
	  									,category_description
	  									,priority_code
	  									,assigned_to
	  									,bin
	  									,house_number
	  									,street_name
	  									,block
	  									,lot
	  									,community_board
	  									,entry_date
	  									,last_inspection_date
	  									,last_disposition_date
	  									,disposition_code
	  									,disposition_code_description
	  									,disposition_comments
	  									,dob_violation_number
	  									,ecb_violation_number
	  									,finance_owner_name
	  									,addr_id
	  								) 
	  								VALUES
	  								(
	  									'$complaint_number'
										,'$complaint_reason'
										,'$complaint_category'
										,'$complaint_category_description'
										,'$priority_code'
										,'$assigned_to'
										,'$bin'
										,'$house_number'
										,'$street_name'
										,'$block'
										,'$lot'
										,'$community_board'
										,'$entry_date'
										,'$last_inspection_date'
										,'$last_disposition_date'
										,'$disposition_code'
										,'$disposition_code_description'
										,'$disposition_comments'
										,'$dob_violation_number'
										,'$ecb_violation_number'
										,'$finance_owner_name'
										,'$a_id'
	  								)"
	  						,$DB);
		  		/*if (!$sql) {
				    die('Invalid query: ' . mysql_error());
				}*/
	  		
  		}
  		
  		return TRUE;
		
	}
	
	function insert_dob($data_dump)
	{
		//var_dump($data_dump->complaint_number);
		$complaint_number = $data_dump->complaint_number;
		$complaint_reason = $this->mysql_prep($data_dump->complaint_reason);
		$complaint_category = $data_dump->complaint_category;
		$complaint_category_description = $this->mysql_prep($data_dump->complaint_category_description);
		$priority_code = $data_dump->priority_code;
		$assigned_to = $data_dump->assigned_to;
		$bin = $data_dump->bin;
		$house_number = $data_dump->house_number;
		$street_name = $data_dump->street_name;
		$block = $data_dump->block;
		$lot = $data_dump->lot;
		$community_board = $data_dump->community_board;
		$entry_date = $data_dump->entry_date;
		$last_inspection_date = $data_dump->last_inspection_date;
		$last_disposition_date = $data_dump->last_disposition_date;
		$disposition_code = $data_dump->disposition_code;
		$disposition_code_description = $this->mysql_prep($data_dump->disposition_code_description);
		$disposition_comments = $this->mysql_prep($data_dump->disposition_comments);
		$dob_violation_number = $data_dump->dob_violation_number;
		$ecb_violation_number = $data_dump->ecb_violation_number;
		$finance_owner_name = $this->mysql_prep($data_dump->finance_owner_name);
		
		
		//log into database
  		$mDB = new GSNLogin();
  		$DB = $mDB->GSNLogin();
  		
  		//check for dups
		$sql = mysql_query("		
  							SELECT 
  							Complaint_Number
  							FROM
  							exp_pad_dob_complaints
  							WHERE
  							Complaint_Number = '$data_dump->complaint_number'
  							", $DB);
  		//var_dump($sql);
  		$num_rows = mysql_num_rows($sql);
  		var_dump($num_rows);
		
		if($num_rows == 0)
  		{
  			var_dump('hi '.$data_dump->complaint_number);
  			$sql =  mysql_query("
	  								INSERT INTO exp_pad_dob_complaints
	  								(
	  									Complaint_Number
	  									,Complaint_Reason
	  									,Complaint_Category
	  									,Complaint_Category_Description
	  									,Priority_Code
	  									,Assigned_To
	  									,BIN_Number
	  									,House_Number
	  									,Street_Name
	  									,Block
	  									,Lot
	  									,Community_Board
	  									,Entry_Date
	  									,Last_Inspection_Date
	  									,Last_Disposition_Date
	  									,Disposition_Code
	  									,Disposition_Code_Description
	  									,Disposition_Comments
	  									,DOB_Violation_Number
	  									,ECB_Violation_Number
	  									,Finance_Owner_Name
	  								) 
	  								VALUES
	  								(
	  									'$complaint_number'
										,'$complaint_reason'
										,'$complaint_category'
										,'$complaint_category_description'
										,'$priority_code'
										,'$assigned_to'
										,'$bin'
										,'$house_number'
										,'$street_name'
										,'$block'
										,'$lot'
										,'$community_board'
										,'$entry_date'
										,'$last_inspection_date'
										,'$last_disposition_date'
										,'$disposition_code'
										,'$disposition_code_description'
										,'$disposition_comments'
										,'$dob_violation_number'
										,'$ecb_violation_number'
										,'$finance_owner_name'
	  								)"
	  						,$DB);
		  		/*if (!$sql) {
				    die('Invalid query: ' . mysql_error());
				}*/
	  		
  		}
  		
  		return TRUE;
		
	}
	
	function import_addr($in, $out)
	{
		set_time_limit(0);
		ini_set('memory_limit','16M');
		
		$this->inputurl=$in;
		$this->outputurl=$out;
		$this->handle = fopen($this->inputurl, 'r');
		$this->file = fopen($this->outputurl, 'w');
		$this->line = count(file($this->handle));
		
		$data_dump = new stdclass();
		
  		$my_count = 0;
		//loop the csv
		while (($data = fgetcsv($this->handle, $this->line, ",")) !== FALSE) 
		{
			
			$my_count++;
			var_dump('count= ' . $my_count);
			//1 starts the column names
			//2 starts the data
			if($my_count > 1)
			{
				foreach($data as $key => $value) {
					
					//var_dump('v=' . $value);
					//var_dump('k=' . $key);
					//fwrite($this->file, $value. ",");
					
					$data_dump->boro = $data[0];
					$data_dump->block = $data[1];
					$data_dump->lot = $data[2];
					$data_dump->bin = $data[3];
					$data_dump->lhnd = $data[4];
					$data_dump->lhns = $data[5];
					$data_dump->lcontpar = $data[6];
					$data_dump->lsos = $data[7];
					$data_dump->hhnd = $data[8];
					$data_dump->hhns = $data[9];
					$data_dump->hcontpar = $data[10];
					$data_dump->hsos = $data[11];
					$data_dump->scboro = $data[12];
					$data_dump->sc5 = $data[13];
					$data_dump->sclgc = $data[14];
					$data_dump->st_name = $data[15];
					$data_dump->type = $data[16];
					$data_dump->b7sc = $data[17];
					$data_dump->vlgcs = $data[18];
					$data_dump->parity = $data[19];
					$data_dump->b10sc = $data[20];
					
				}
				//var_dump($data_dump);
				
				$test = $this->insert_addr($data_dump);
				//var_dump($test);
				
			}
			
			
		}
	}
	
	function insert_addr($data_dump)
	{
		
		$boro = $data_dump->boro;
		$block = $data_dump->block;
		$lot = $data_dump->lot;
		$bin = $data_dump->bin;
		$lhnd = $data_dump->lhnd;
		$lhns = $data_dump->lhns;
		$lcontpar = $data_dump->lcontpar;
		$lsos = $data_dump->lsos;
		$hhnd = $data_dump->hhnd;
		$hhns = $data_dump->hhns;
		$hcontpar = $data_dump->hcontpar;
		$hsos = $data_dump->hsos;
		$scboro = $data_dump->scboro;
		$sc5 = $data_dump->sc5;
		$sclgc = $data_dump->sclgc;
		$st_name = $data_dump->st_name;
		$type = $data_dump->type;
		$b7sc = $data_dump->b7sc;
		$vlgcs = $data_dump->vlgcs;
		$parity = $data_dump->parity;
		$b10sc = $data_dump->b10sc;
		
		//log into database
  		$mDB = new GSNLogin();
  		$DB = $mDB->GSNLogin();
  		
  		//check for dups
  		$sql = mysql_query("		
  							SELECT Addr_Id 
  							FROM exp_gsn_addr
  							WHERE boro = $boro
  							AND block = '$block'
  							AND lot = '$lot'
  							AND bin = '$bin'
  							AND lhnd = '$lhnd'
  							AND lhns = '$lhns'
  							AND lcontpar = '$lcontpar'
  							AND lsos = '$lsos'
  							AND hhnd = '$hhnd'
  							AND hhns = '$hhns'
  							AND hcontpar = '$hcontpar'
  							AND hsos = '$hsos'
  							AND scboro = '$scboro'
  							AND sc5 = '$sc5'
  							AND sclgc = '$sclgc'
  							AND stname = '$st_name'
  							AND addrtype = '$type'
  							AND realb7sc = '$b7sc'
  							AND validlgcs = '$vlgcs'
  							AND parity = '$parity'
  							AND b10sc = '$b10sc'
  							
  							", $DB);
  		
  		$num_rows = mysql_num_rows($sql);
  		
  		
  		if($num_rows == 0)
  		{
  			
	  		$sql =  mysql_query("
	  								INSERT INTO exp_gsn_addr
	  								(
	  									boro
	  									,block
	  									,lot
	  									,bin
	  									,lhnd
	  									,lhns
	  									,lcontpar
	  									,lsos
	  									,hhnd
	  									,hhns
	  									,hcontpar
	  									,hsos
	  									,scboro
	  									,sc5
	  									,sclgc
	  									,stname
	  									,addrtype
	  									,realb7sc
	  									,validlgcs
	  									,parity
	  									,b10sc
	  								) 
	  								VALUES
	  								(
	  									'$boro'
										,'$block'
										,'$lot'
										,'$bin'
										,'$lhnd'
										,'$lhns'
										,'$lcontpar'
										,'$lsos'
										,'$hhnd'
										,'$hhns'
										,'$hcontpar'
										,'$hsos'
										,'$scboro'
										,'$sc5'
										,'$sclgc'
										,'$st_name'
										,'$type'
										,'$b7sc'
										,'$vlgcs'
										,'$parity'
										,'$b10sc'
	  								)"
	  						,$DB);
  		}
  		
  		return TRUE;
	}	
	
	/**
	 * Prep the string to escape any chars
	 * @param string $str the string to be escaped 
	 * @return returns the new string
	 */
	function mysql_prep($value) 
    { 
        if(get_magic_quotes_gpc()){ 
            $value = stripslashes($value); 
        } else { 
            $value = addslashes($value); 
        } 
        return $value; 
    }
}

?>
