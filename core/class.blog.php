<?php

class Blog{

    function setAddBlog($values){
        return set_insert("blog", $values, 1);
    }

    function setUpdateBlog($id, $values){
        return set_update("blog", $values, $id, 1);
    }

    function setDeleteBlog($id){
        return set_delete("blog", "id='".$id."'", 1);
    }

    function getBlog($where = null){
        $request = "SELECT * FROM blog ";
        if($where) $request .= " WHERE ".$where;
        return get_result($request);
    }

    function getLstBlog($where = null){
        $request = "SELECT * FROM blog ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
    
    function getPostWithId($id){
        $request = "SELECT * FROM blog WHERE id='".$id."'";
        return get_result($request);
    }

    function getPostWithUrl($url){
        $request = "SELECT * FROM blog WHERE post_url='".$url."'";
        return get_result($request);
    }

    function getAuthorData($id_user){
        $request = "SELECT email, last_name, first_name, display_name, dog_name FROM users WHERE id='".$id_user."'";
        return get_result($request);
    }

    function getPostRecent(){
        $request = "SELECT * FROM blog ORDER BY post_date DESC LIMIT 0,3";
        return get_results($request);
    }


    /********************  POST CATEGORY  ********************/
    function getPostCategory($id_post){
        $request = "SELECT * FROM blog_category WHERE id_post='".$id_post."'";
        return get_result($request);
    }


    /********************  CATEGORY  ********************/
    function getLstCategory($where = null){
        $request = "SELECT * FROM category ";
        if($where != null)
            $request .=  " WHERE ".$where;
        return get_results($request);
    }

    function getNbPostCategory($id_category){
        $request = "SELECT DISTINCT COUNT(`blog_category`.`id_post`) as total FROM blog, blog_category WHERE `blog`.`id_post` = `blog_category`.`id_post` AND post_status = 1 AND post_visibility = 0 AND id_category = '".$id_category."'";
        return get_result($request)['total'];
    }

}

 ?>