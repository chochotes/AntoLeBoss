<?php

class Module{

    function setAddModule($values){
        return set_insert("module", $values, 1);
    }

    function setUpdateModule($id, $values){
        return set_update("module", $values, 'id="'.$id.'"', 1);
    }

    function setDeleteModule($id){
        return set_delete("module", "id='".$id."'", 1);
    }
    
    function getModule($where){
        $request = "SELECT * FROM module WHERE ".$where;
        return get_result($request);
    }
    
    function getLstModule($where = null){
        $request = "SELECT * FROM module ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }


}