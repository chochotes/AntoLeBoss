<?php

/**
 *
 */
class Admin
{

    function log_admin($email, $password){
        $requete = "SELECT * FROM client WHERE (droit = 'administrator' OR droit LIKE 'administrator-%') AND email = '".$email."'";
        $data = get_result($requete);
        
        if($data){
            if(hash('sha256', $password) == $data['password']){
                $_SESSION['adminId'] = $data['id'];
                $_SESSION['adminNom'] = $data['last_name'];
                $_SESSION['adminPrenom'] = $data['first_name'];
                $_SESSION['adminEmail'] = $data['email'];
                $_SESSION['droit'] = $data['droit'];
                return true;
            }
            else{
                return false;
            }
        }
    }
    
    function addEditionHistoric($table_name, $table_id, $action, $success){
        $values = array(
            "table_name" => $table_name,
            "table_id" => $table_id,
            "action" => $action,
            "statut" => $success,
            "id_user" => $_SESSION['adminId'],
            "date_modification" => date('Y-m-d H:i:s'),
        );
        set_insert("admin_edition_historique", $values);
    }
    
    function getLstEditionHistorique($where = null, $order = null, $limit = null){
        $request = "SELECT * FROM admin_edition_historique";
        if($where) $request.= " WHERE ".$where;
        if($order) $request.= " ORDER BY ".$order;
        if($limit) $request.= " LIMIT ".$limit;
        return get_results($request);
    }


}


 ?>