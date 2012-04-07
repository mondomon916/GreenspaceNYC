<!-- URL that generated this code: -->
<!-- http://txt2re.com/index-javascript.php3?s=PF13172001020&34&1 -->

<html>
  <body>
    <script language=javascript>
      var txt='11   1 AVENUE NORTHBOUND ROADBED  VF11001006010  N 30   1 AVENUE NORTHBOUND ROADBED';

      var re1='((?:[a-z][a-z]*[0-9]+[a-z0-9]*))';	// Alphanum 1
      var re2='(.)';	// Any Single Character 1

	  console.log(txt);
		
      var p = new RegExp(re1,["i"]);
      console.log(p);
      var m = p.exec(txt);
      console.log(m);
      console.log('yes'+txt.match(p))
      /*if (m != null)
      {
          var alphanum1=m[1];
          console.log(alphanum1);
          var c1=m[2];
          document.write("("+alphanum1.replace(/</,"&#38;lt;")+")"+"("+c1.replace(/</,"&#38;lt;")+")"+"\n");
      }*/
    </script>
    
    <?php
		/*$text = "11   1 AVENUE NORTHBOUND ROADBED  VF11001006010  N 30   1 AVENUE NORTHBOUND ROADBED";
		$newtext = wordwrap($text, 36, "<br />\n");
		
		echo $newtext;*/
		
		/** 
		 * Split a string into groups of words with a line no longer than $max 
		 * characters. 
		 * 
		 * @param string $string 
		 * @param integer $max 
		 * @return array 
		 **/ 
		function split_words($string, $max = 1) 
		{ 
			  
      		$pattern = '/((?:[a-z][a-z]*[0-9]+[a-z0-9]*))/i';
		    $words = preg_split($pattern, $string);
		    $lines = array(); 
		    $line = '';
		    $my_match = ''; 
		    
		    //get the pattern match value
		    $my_match = find_pattern($string);
		    
		    foreach ($words as $k => $word) { 
		        $length = strlen($line . ' ' . $word); 
		        if ($length <= $max) { 
		            $line .= ' ' . $word; 
		        } else if ($length > $max) { 
		            if (!empty($line)) $lines[] = trim($line); 
		            $line = $word; 
		        } else { 
		            $lines[] = trim($line) . ' ' . $word; 
		            $line = ''; 
		        } 
		    } 
		    
		    $lines[] = ($line = trim($line)) ? $line : $word; 
			
		    var_dump('i=' . strlen($my_match));
		    
		    $tmp = strlen($my_match);
		    if($tmp == 13)
		    {
		    	$t = parse_str_type($my_match,$po='','');
		    }
		    else 
		    {
		    	$t = parse_str_type($my_match,$po=$lines[1],'s');
		    }
		    
		    var_dump($t);
		    
		    return $lines;
		    
		    //create an array out of the lines
		    $pieces = explode(",", $lines[0]);
		    //get the street name
			$street_obj = parse_street($pieces);
		    //import the data into the database
			//create an object to hold the data
			$rData = new stdclass();
			$rData->street = $street_obj->str_name;
			$rData->boro = $street_obj->boro;
			$rData->str_code = '';
			$rData->local_group_code = '';
			
			var_dump($street_obj);
			
		    return true; 
		} 
		
		function parse_str_type($string,$po='',$type='')
		{
			var_dump($string . '|' . $po . '|' . $type);
			switch ($type)
			{
				case 's':
					//parse type-s records NS161E,11703001010
					
					break;
				case '':
					//parse non-type-s records VS13262201080
					break;
			}
		}
		
		function find_pattern($string)
		{
			//set the default params
			$pattern = '/((?:[a-z][a-z]*[0-9]+[a-z0-9]*))/i';
			$p_match = '';
			
			//find the pattern match; returns an array
			preg_match($pattern,$string,$matches);
			//set the match
			$p_match = $matches[0]; 
			
			//return the match
			return $p_match;
			
		}
		
		function parse_street($str_array)
		{
			//start at $str_array[3] - boro code | $str_array[4]- $str_array[sizeof($str_array)-1] - street name
			$arr_len = sizeof($str_array)-1;
			$arr_len_real = sizeof($str_array);
			$str_data = '';
			
			$str_name = '';
			for($i=4; $i < $arr_len; $i++)
			{
				$str_name .= $str_array[$i] . ' ';
			}
			
			$str_data = new stdclass();
			$str_data->boro = $str_array[3];
			$str_data->str_name = $str_name;
			
			return $str_data;
		}
		
		$test = "11,,,1,AVENUE,LOWER,NB,ROADBED,,,,PF11001001010,,N,11,,,1,AVENUE,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,0,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,";
		$test2 = '11,,,1,STREET,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,NS161E,11701001010,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,0,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,';
		
		$mytest = split_words($test2,36);
		var_dump($mytest);
		
		//$pieces = explode(",", $mytest[0]);
		//$test2 = parse_street($pieces);
		//var_dump($test2);
    ?>
    
  </body>
</html>

<!-- -->
<!-- Paste the code into a file that can be served by your web server -->
<!-- or into a local file that can be read by your browser -->
<!-- -->