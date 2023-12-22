<?php

class Pages{

    function setAddPages($values){
        return set_insert("pages", $values, 1);
    }

    function setUpdatePages($id, $values){
        return set_update("pages", $values, $id, 1);
    }

    function setDeletePages($id){
        return set_delete("pages", "id='".$id."'", 1);
    }

    function getPages($where){
        $request = "SELECT * FROM pages WHERE ".$where;
        return get_result($request);
    }

    function getLstPages($where = null){
        $request = "SELECT * FROM pages ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
    
    function getFaq($where = null){
        $request = "SELECT * FROM faq ";
        if($where)
            $request .= " WHERE ".$where;
        $request .= " ORDER BY position";
        return get_results($request);
    }
    
    /************************* Redirection *************************/
    
    function setAddRedirection($values){
        return set_insert("redirection", $values, 1);
    }

    function setUpdateRedirection($id, $values){
        return set_update("redirection", $values, $id, 1);
    }

    function setDeleteRedirection($id){
        return set_delete("redirection", "id='".$id."'", 1);
    }
    
    function getRedirection($where = null){
        $request = "SELECT * FROM redirection ";
        if($where)
            $request .= " WHERE ".$where;
        return get_result($request);
    }
    
    function getLstRedirection($where = null){
        $request = "SELECT * FROM redirection ";
        if($where) $request = " WHERE ".$where;
        return get_results($request);
    }
    
}

 ?>