<?php

    function validData($arr=null,$keys=null){//funcion 'isset', paso $arr null para revisar $_POST.
        if($arr==null){
            foreach($keys as $k){
                if( !isset($_POST[$k]) || $_POST[$k]=='' ){
                    return false;
                }
            }
            return true;
        }else{
            foreach($keys as $k){
                if( !isset($arr[$k]) || $arr[$k]=='' ){
                    return false;
                }
            }
            return true;
        }
    }