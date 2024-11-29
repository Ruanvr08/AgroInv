<?php

Class Valida{
    public static function validarNome($nome){
        if(!preg_match('/^[a-zA-ZÀ-ú\s]+$/', $nome)){
            return true;
        }else{
            return false;
        }
    }
    public static function validarEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
    public static function validarData($data){
        return date('d/m/Y H:i:s', strtotime($data));
    }

}