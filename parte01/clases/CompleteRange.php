<?php

class CompleteRange {
    //put your code here
    public function build(array $params){
        
        $num = count($params);
        $current = $params[0];
        $index = 0;
        $result = array();
        while ($index < $num) {
            $value = $params[$index];
            if ($value - $current > 1 ){
                $current++;
                $result[] = $current;
                
            }else{
                $result[] = $value;
                $current = $value;
                $index++;
            }
        }
        
        return $result;
    }
}
