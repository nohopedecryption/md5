<?php
    
    set_time_limit(0);

    function getmicrotime() { //Uhm geen idee waar ik deze functie vandaan heb o.O
       list($usec, $sec) = explode(" ", microtime());
       return ((float)$usec + (float)$sec);
    } 
     
    $time_start = getmicrotime(); //Begin tijd.
    
    function x($string, $maxLength, $hash, $chars) {
        global $time_start;
        
        if (strlen($string) > $maxLength) return false; //Stoppen wanneer de maximale lengte is berijkt.
        
        foreach($chars as $char) {
            if (md5($string.$char) == $hash) {
                echo "Found string: ".$string.$char;
                echo "<br /><small>Time: ".round((getmicrotime() - $time_start), 9)." seconds.</small>";
                exit(); //Het script stoppen (beetje slordig maar wist geen andere manier).
            }
        }
        
        foreach($chars as $newStr) {
            x($string.$newStr, $maxLength, $hash, $chars);
        }
    }
    
    function bruteForce($hash, $maxLength, $chars) {
        for ($i=0; $i<$maxLength; $i++) {
            foreach($chars as $char) {
                if ($i==0) {
                    $char = "";
                }
                
                x($char, $i, $hash, $chars);
            }
        }
    }
    
    $hash = $_POST['hash'];
    $chars = str_split("abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"); //Het moet een array zijn van alle karakters die je wilt gebruiken.
    
    bruteForce($hash, 8, $chars);
?>
