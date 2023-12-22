<?php

class Url{

    function setAddUrl($values){
        return set_insert("pages_url", $values, 1);
    }

    function setUpdateUrl($id, $values){
        return set_update("pages_url", $values, $id, 1);
    }

    function setDeleteUrl($id){
        return set_delete("pages_url", "id='".$id."'", 1);
    }

}

 ?>