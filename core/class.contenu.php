<?php

class Contenu{

    function setAddContenu($values){
        return set_insert("contenu", $values, 1);
    }

    function setUpdateContenu($id, $values){
        return set_update("contenu", $values, 'id="'.$id.'"', 1);
    }

    function setDeleteContenu($id){
        return set_delete("contenu", "id='".$id."'", 1);
    }
    
    function getContenu($where){
        $request = "SELECT * FROM contenu WHERE ".$where;
        return get_result($request);
    }
    
    function getLstContenu($where = null){
        $request = "SELECT * FROM contenu ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
    
    function getContenuByIdentifiant($identifiant){
        $request = "SELECT * FROM contenu WHERE identifiant='".$identifiant."'";
        return get_result($request)['contenu'];
    }
    
}