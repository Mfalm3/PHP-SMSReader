<?php
		
		include_once('Utils.php');

		$f2get = file_get_contents("xmls/sweet201609191454.xml");
		$smsxml = simplexml_load_string($f2get) or die("Error:Cannot create object");


			//get all thread_ids and put them into an array
    			$Id_array = array();
						if($foreach = $smsxml->xpath('//thread_id'))
					{
  					foreach($foreach as $node)
  						{
    							$Id_array['thread_id'][]= (string) $node;
  						}
					}
			//output one instance of a thread_id if it occurs more than once
				$T_id = array_unique($Id_array['thread_id']);


			//get the single instances of thread_ids obtained above and put them in an array
				$T_Id_arr = array();
						foreach ($T_id as $val) {
								$T_Id_arr['ct'][] = (string) $val;
				}
									//print_r($T_Id_arr['ct']);
echo count($Id_array['thread_id'])."<br>";

			//get the values in the array and assign them indices
 				for($r = 0;$r < (count($T_Id_arr['ct'])); $r++){
						//echo $T_Id_arr['ct'][($r)]. '<br>';
 					$num [] = (string)$T_Id_arr['ct'][($r)];
$n = 0;
for ($n; $n = $$T_Id_arr['ct'][($r)]; $n++) { 
 	echo $T_Id_arr['ct'][$r]($n);
 } 




				$txt = array();
				if($ujumbe = $smsxml->xpath('//body'))
					{
						foreach ($ujumbe as $chombo)
						{
							$txt['jumla'][] = (string) $chombo;
						}
					}
					print_r($txt['jumla']);

}
?>
