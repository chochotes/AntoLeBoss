<?php

class Stock{

    function setAddStock($values){
        return set_insert("stock", $values, 1);
    }

    function setUpdateStock($id, $values){
        return set_update("stock", $values, 'id="'.$id.'"', 1);
    }

    function setDeleteStock($id){
        return set_delete("stock", "id='".$id."'", 1);
    }
    
    function getStock($where){
        $request = "SELECT * FROM stock WHERE ".$where;
        return get_result($request);
    }
    
    function getLstStock($where = null){
        $request = "SELECT * FROM stock ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
    
    function getStockByIdentifiant($identifiant){
        $request = "SELECT * FROM stock WHERE identifiant='".$identifiant."'";
        return get_result($request)['stock'];
    }
}