<?php
/*
 * Created on Oct 28, 2009
 * 
 * @author Raymond Manalo
 * Housing Works Inc.
 * R.Manalo@housingworks.org
 * 
 * This class will be the login functions for expression engine
 */
 
class GSNLogin{
	
	/*var $dbIP = '209.200.244.80';
	var $dbUN = 'torso0_ee499602d';
	var $dbPW = 'gsn499602d3';*/
	
	/**
	 * Log into Expression Engine Database
	 * @param string $dpIP the IP of the database
	 * @param string $dbUN the username
	 * @param string $dbPW the password
	 * @return returns the database connection
	 * */
	public function GSNLogin($dbIP='209.200.244.80',$dbUN='torso0_ee499602d',$dbPW='gsn499602d3')
	{
		//database settings
  		$DB = mysql_connect($dbIP,$dbUN,$dbPW) or die('Could not connect: ' . mysql_error());
  		mysql_select_db('torso0_eegsn', $DB) or die('Could not select database.');
  		
  		return $DB;
	}
}
?>
