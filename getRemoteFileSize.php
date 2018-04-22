<?php
function getRemoteFileSize($url){
   $parse = parse_url($url);
   if(isset($parse['host'])){
     $host = $parse['host'];
     $fp = @fsockopen ($host, 80, $errno, $errstr, 20);
     if(!$fp){
       $ret = 0;
     }else{
       $host = $parse['host'];
       fputs($fp, "HEAD ".$url." HTTP/1.1\r\n");
       fputs($fp, "HOST: ".$host."\r\n");
       fputs($fp, "Connection: close\r\n\r\n");
       $headers = "";
       while (!feof($fp)){
         $headers .= fgets ($fp, 128);
       }
       fclose ($fp);
       $headers = strtolower($headers);
       $array = preg_split("|[\s,]+|",$headers);
       $key = array_search('content-length:',$array);
       $ret = $array[$key+1];
     }
     if($array[1]==200) return $ret;
     else return -1*$array[1];
   }
 }


 ?>