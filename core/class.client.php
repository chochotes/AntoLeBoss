<?php

class Client{
    
    function login($email){
        $result = get_result("SELECT * FROM client WHERE email = '".$email."'");
        return $result;
    }
    
    function getDataClient($idUser, $emailUser){
        $result = get_result("SELECT * FROM client WHERE id = '".$idUser."' AND email = '".$emailUser."'");
        return $result;
    }
    
    function updateDataClient($idUser, $dataUser){
        return set_update("client", $dataUser, "id = '".$idUser."'", true);
    }
    
    function getPasswordClient($idUser){
        $result = get_result("SELECT password FROM client WHERE id='".$idUser."'");
        return $result;
    }
    
    function updatePasswordClient($idUser, $passwordUser, $newPassword){
        $passwordUser = hash('sha256', $passwordUser);
        $dataUser = $this->getPasswordClient($idUser);
        if($passwordUser == $dataUser['password']){
            $newPassword = hash('sha256', $newPassword);
            $values= array(
                "password" => $newPassword,
            );
            return set_update("client", $values, "id='".$idUser."'", true);
        }
        else
            return false;
    }
    
    function addClient($email, $password){
        $password = hash('sha256', $password);
        if($password == $dataUser['password']){
            $values= array(
                "email" => $email,
                "password" => $password,
            );
            return set_update("client", $values, "id='".$idUser."'", true);
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
    
    function getClient($where){
        return get_result("SELECT * FROM client WHERE ".$where);
    }
    
    function getLstClient($where = null){
        $request = "SELECT * FROM client ";
        if($where) $request .= "WHERE ".$where;
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