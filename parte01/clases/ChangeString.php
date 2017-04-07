<?php

class ChangeString {
    //put your code here
    
    public function build($param){
        $min = 96;
        $max = 122;
        
        $min1 = 64;
        $max1 = 90;
        
        $cadena = str_split($param);
        $result = "";
        
        foreach ($cadena as $index => $caracter):
            $ord = ord($caracter);
            
            if (($min1 < $ord AND $ord < $max1) OR ($min < $ord AND $ord < $max)) {
                $ord++;
            }elseif ($ord == 122){
                $ord = 97;
            }elseif ($ord == 90){
                $ord = 65;
            }
            $result .= chr($ord);
        endforeach;
            
        return $result;
    }
}
