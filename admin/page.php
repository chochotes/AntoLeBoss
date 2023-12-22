<?php

    include '../parametres/constante.php';
    include URLSITEABS . 'admin/parametres/constante.php';
    
    if(!isset($_SESSION['adminId']) || $_SESSION['adminId'] == "")
    {
        Header('Location: ../index.php');
        exit();
    }
    else
    {
        $link = 'pages/templates/';
        
        if(isset($_GET['module']) && $_GET['module']){
            $module = $Tools->data_secure($_GET['module']);
            $_SESSION['module'] = $module;
        }else $_SESSION['module'] = "";
                
        if(isset($_GET['page']) && $_GET['page']){
            $page = $Tools->data_secure($_GET['page']);
            $_SESSION['page'] = $page;
        }else $_SESSION['page'] = null;
        
        if(isset($_GET['action']) && $_GET['action']){
            $action = $Tools->data_secure($_GET['action']);
            $_SESSION['action'] = $action;
        }else $_SESSION['action'] = null;
        
        
        
        switch ($page) {
            case 'accueil': include($link.'accueil.php'); break;
            case 'tableaudebord': include($link.'tableaudebord.php'); break;
            case 'logout': include($link.'logout.php'); break;
            default:
                if($action == "edit") $url = $link.$module.'/'.$page.'-edit.php';
                elseif($action == "consulter") $url = $link.$module.'/'.$page.'-consulter.php';
                elseif($action == "envoyer") $url = $link.$module.'/'.$page.'-envoyer.php';
                else $url = $link.$module.'/'.$page.'.php';
                
                include $url;
                break;
        }
    }


 ?>