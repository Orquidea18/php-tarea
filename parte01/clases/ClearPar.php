<?php

class ClearPar {

    //put your code here
    public function build($param) {

        $array = str_split($param);

        $open = FALSE;
        $cadena = "";
        foreach ($array as $value) {
            if ($open) {
                if ($value == ")") {
                    $cadena .= $value;
                    $open = FALSE;
                }
            } else {
                if ($value == "(") {
                    $cadena .= $value;
                    $open = TRUE;
                }
            }
        }

        $cadena = rtrim($cadena, "(");
        return $cadena;
    }

}
