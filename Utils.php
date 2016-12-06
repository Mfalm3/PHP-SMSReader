<?php
/*
These are functions to be used by the other scripts
Created by Waithaka
*/

//Checks whether the message is incoming or outgoing
function isFromMe(){
global $msgtype, $fromMe;
    if ($msgtype != 1){
        $fromMe = true;
    }elseif ($msgtype == 1) {
      $fromMe = false;
    }
    return $fromMe;
}
function getMaxTimestamp(){
	global $timestamp, $tval,$msgT, $msgtime, $tstamp;
	$msgtime = max('$msgT');
	$timestamp = $msgtime;
	$tval = substr($timestamp, 0, -3);
	$tstamp = date('D H:i:s', $tval);
	return $tstamp;
}

//Convert message timestamps from unix to human readable timestamps
function getTimestamp(){
	global $timestamp,$tval, $msgtime;
    $timestamp = $msgtime;
    $tval = substr($timestamp, 0, -3);
    return $tval;
}


//format timestamps for conversation view
function formatTimestampChat(){
	global $timestamp, $tval, $tstamp;
     getTimestamp();
     $tstamp1 = date('D H:i:s', $tval);
     $tstamp2 = date('d-M-Y', $tval);
     $tstamp = $tstamp1. '<br>' . $tstamp2;
     return $tstamp;    
}

//format timestamps for conversationlist view
function formatTimestampThread(){
	global $timestamp, $tval, $tstamp;
     getTimestamp();
     $tstamp1 = date('D H:i', $tval);
     $tstamp2 = date('d|M|Y', $tval);
     $tstamp = $tstamp1. ' ' . $tstamp2;
     return $tstamp;    
}

function getSmsBody(){
	global $msgbody;
	return;
}

/*
-format number by removing country code and appending zero while stripping off any whitespace in the number
-hide three digits of the number for security purposes
*/
function formatNumber(){
    global $msgthread;
    $msgthread = preg_replace('/^[\+254]{3,}/', 0, $msgthread);
    $msgthread = preg_replace('/(?<=\d)\s+(?=\d)/', '', $msgthread);
    if(ctype_digit($msgthread))
    {
    	 $msgthread = substr_replace($msgthread, '***', -5, 3);
 	}
    return $msgthread;
}

//generate random material colors for avi background
function formatColor(){
	global $rand_background,$background_colors;
	$background_colors = array('#006400', '#8B008B', '#8B0000', '#FF1493', '#00BFFF', '#8B008B', '#FF4500', '#D2691E');
	$rand_background = $background_colors[array_rand($background_colors)];
	return $rand_background;
}

//format the conversationlist view to contain a snippet of the message body that has 40 characters
function formatMsgBody(){
	global $msgbody, $msg;
	gfSafety();
	$msg = strlen($msgbody);
	if ($msg > 40){
		$msgbody = substr($msgbody, 0,40)."....";
	}else{
		$msgbody = $msgbody;
	}
	return $msgbody;
}

function gfSafety(){
/*
When making these scripts I had the idea of showing off the project to my girlfriend. I had to use my own message
backups for testing purposes. there had to be a few minor adjustments put in place to keep at bay any storms over
paradise
*/

	global $msgbody;
	$altstring = ['mtu nguyaz','boss','guka','buda','mzae'];//string to be replaced in instances of "Hun,honey,babe" from tushugwa
	$altstring1 = ['ntakujenga','ntakupigia baadae','sidai story']; //string to be replaced in instances of "nakupenda, love you"
	
	$rand = rand(0,count($altstring)-1);
	$random_replace_string = $altstring[$rand];

	$rand2 = rand(0,count($altstring1)-1);
	$random_replace_string1 = $altstring1[$rand2];

	$msgbody = preg_replace('/(\blove\s+you)/', $random_replace_string1 , $msgbody);
	$msgbody = preg_replace('/(\b[Bb]ab?e)/', $random_replace_string , $msgbody);
	$msgbody = preg_replace('/(\b[Hh]un)/', $random_replace_string , $msgbody);
	
	return $msgbody;
}

function getRecentTimestamp(){
	global $timestamp, $tval, $tstamp;
	$wakati = array();
	if($eachtime = $smsxml->xpath('//date'))
				{
  					foreach($eachtime as $node)
  				{
    				$Id_array['date'][]= (string) $node;
  					}
				}

}

//lists all available sms logs in the directory 
function list_files(){
	global $file;
	$dir = "assets/files/";
if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'xml')
        {
            echo '<tr><td background="assets/img/fade.gif"><a href="'.$dir.$file.'">'.$file.'</a></td></tr>';
        }
    }
   return
		 closedir($handle);
}
}
