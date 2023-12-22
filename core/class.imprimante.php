<?php

class Imprimante{

    function setAddImprimante($values){
        return set_insert("imprimante", $values, 1);
    }

    function setUpdateImprimante($id, $values){
        return set_update("imprimante", $values, $id, 1);
    }

    function setDeleteImprimante($id){
        return set_delete("imprimante", "id='".$id."'", 1);
    }
    
    function getImprimante($where){
        $request = "SELECT * FROM imprimante WHERE ".$where;
        return get_result($request);
    }
    
    function getLstImprimante($where = null){
        $request = "SELECT * FROM imprimante ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
    
    /******************************* GESTION FILAMENT *******************************/
    
    function setAddFilament($values){
        return set_insert("imprimante_filament", $values, 1);
    }

    function setUpdateFilament($id, $values){
        return set_update("imprimante_filament", $values, $id, 1);
    }

    function setDeleteFilament($id){
        return set_delete("imprimante_filament", "id='".$id."'", 1);
    }
    
    function getFilamentsWhere($where = null){
        $request = "SELECT * FROM imprimante_filament ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
    
    
    function getLstFilament($where = null){
        $request = get_results("SELECT * FROM imprimante_filament ");
        if($where) $request .= " WHERE ".$where;
        return $request;
    }
    
    function getFilament($where){
        return get_result("SELECT * FROM imprimante_filament WHERE ".$where);
    }
    
    function printLstColorProduit($color){
        $color = str_replace(";;", ";", $color);
        $lstColor = explode(";", $color);
        
        foreach($lstColor as $idColor){
            if($idColor){
                $dataColor = $this->getFilament('id="'.$idColor.'"');
                if($dataColor['statut'] == 1){
                    $printColor = $dataColor['code_couleur'];
                    if($printColor == "255,255,255,1") $bgColor = "0,0,0,1";
                    else $bgColor = $printColor;
                    echo '<div class="col-3 col-md-2"><div class="div-color" onclick="changeColor('.$dataColor['id'].')" id="'.$dataColor['id'].'"><div class="div-color-center" style="background-color: rgba('.$printColor.'); border: 1px solid rgba('.$bgColor.');" ></div></div></div>';
                }
            }
        }
    }
    
    function printColorProduit($idColor, $inlineBlock = null){
        $dataColor = $this->getFilament('id="'.$idColor.'"');
        if($dataColor['statut'] == 1){
            $printColor = $dataColor['code_couleur'];
            if($printColor == "255,255,255,1") $bgColor = "0,0,0,1";
            else $bgColor = $printColor;
            echo '<div class="div-color-center ';
            if($inlineBlock) echo 'd-inline-block';
            echo '" style="background-color: rgba('.$printColor.'); border: 1px solid rgba('.$bgColor.');" ></div>';
        }
    }

    
    /******************************* GESTION DU STOCK *******************************/
    
    function setAddStock($values){
        return set_insert("imprimante_stock", $values, 1);
    }

    function setUpdateStock($id, $values){
        return set_update("imprimante_stock", $values, $id, 1);
    }

    function setDeleteStock($id){
        return set_delete("imprimante_stock", "id='".$id."'", 1);
    }
    
    function getStock($where){
        $request = "SELECT * FROM imprimante_stock WHERE ".$where;
        return get_result($request);
    }
    
    function getLstStock($where = null){
        $request = "SELECT * FROM imprimante_stock ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }

    
}

 ?>