<?php

class User{
    
    function login($email){
        $result = get_result("SELECT * FROM user WHERE email = '".$email."'");
        return $result;
    }
    
    function getDataUser($idUser, $emailUser){
        $result = get_result("SELECT * FROM user WHERE id = '".$idUser."' AND email = '".$emailUser."'");
        return $result;
    }
    
    function updateDataUser($idUser, $dataUser){
        return set_update("user", $dataUser, "id = '".$idUser."'", true);
    }
    
    function getPasswordUser($idUser){
        $result = get_result("SELECT password FROM user WHERE id='".$idUser."'");
        return $result;
    }
    
    function updatePasswordUser($idUser, $passwordUser, $newPassword){
        $passwordUser = hash('sha256', $passwordUser);
        $dataUser = $this->getPasswordUser($idUser);
        if($passwordUser == $dataUser['password']){
            $newPassword = hash('sha256', $newPassword);
            $values= array(
                "password" => $newPassword,
            );
            return set_update("user", $values, "id='".$idUser."'", true);
        }
        else
            return false;
    }
    
    function addUser($email, $password){
        $password = hash('sha256', $password);
        if($password == $dataUser['password']){
            $values= array(
                "email" => $email,
                "password" => $password,
            );
            return set_update("user", $values, "id='".$idUser."'", true);
        }
        else
            return false;
    }
    
    function log_account(){
        if(!isset($_SESSION['idUser']) || $_SESSION['idUser'] == ""){
            $_SESSION['page_call'] = "https://".$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
            Header("Location: ".URLSITEWEB."se-connecter/");
            exit();
        }
    }
    
    function getUser($where){
        return get_result("SELECT * FROM user WHERE ".$where);
    }
    
    function getLstUser($where = null){
        $request = "SELECT * FROM user ";
        if($where) $request .= $where;
        return get_results($request);
    }
    
    
    /******************************* GESTION ADRESSE *******************************/
    
    function setAddAdresse($values){
        return set_insert("client_adresse", $values, 1);
    }

    function setUpdateAdresse($id, $values){
        return set_update("client_adresse", $values, 'id="'.$id.'"', 1);
    }

    function setDeleteAdresse($id){
        return set_delete("client_adresse", "id='".$id."'", 1);
    }
    
    function getAdresse($where){
        $request = "SELECT * FROM client_adresse WHERE ".$where;
        return get_result($request);
    }
    
    function getLstAdresse($where = null){
        $request = "SELECT * FROM client_adresse ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
    
}