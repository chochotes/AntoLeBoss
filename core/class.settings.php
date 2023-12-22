<?php

class Settings{

    function setAddSetting($values){
        return set_insert("admin_settings", $values, 1);
    }

    function setUpdateSetting($id, $values){
        return set_update("admin_settings", $values, $id, 1);
    }

    function setDeleteSetting($id){
        return set_delete("admin_settings", "id='".$id."'", 1);
    }

    function getSettingWithIdentity($identity){
        $request = "SELECT * FROM admin_settings WHERE identity='".$identity."'";
        return get_result($request);
    }
    
    function getSettingWithId($identity){
        $request = "SELECT * FROM admin_settings WHERE id='".$identity."'";
        return get_result($request);
    }

    function getSettingIdWhere($where = null){
        $request = "SELECT id FROM admin_settings ";
        if($where)
            $request .= " WHERE ".$where;
        return get_result($request)['id'];
    }

    function getSettingsWhere($where = null){
        $request = "SELECT * FROM admin_settings ";
        if($where)
            $request .= " WHERE ".$where;
        return get_results($request);
    }
}

 ?>