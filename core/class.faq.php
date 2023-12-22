<?php

class Faq{

    function setAddFaq($values){
        return set_insert("faq", $values, 1);
    }

    function setUpdateFaq($id, $values){
        return set_update("faq", $values, 'id="'.$id.'"', 1);
    }

    function setDeleteFaq($id){
        return set_delete("faq", "id='".$id."'", 1);
    }
    
    function getFaq($where){
        $request = "SELECT * FROM faq WHERE ".$where;
        return get_result($request);
    }
    
    function getLstFaq($where = null){
        $request = "SELECT * FROM faq ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
   
  
    
}