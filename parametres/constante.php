<?php
session_start();

$http = "https://";

define("URLSITEWEB", $http.$_SERVER['SERVER_NAME']."/");
define("URLADMIN", $http.$_SERVER['SERVER_NAME']."/admin/");
define("URLSITEABS", $_SERVER['DOCUMENT_ROOT'].'/'.'');
define("URLPRODUIT", URLSITEWEB."produit/");
define("URLLOGO", "media/logo/logo.svg");

define("NOMSITE", "NOM SITE QUI VEND DES FLEURS");

$DEBUG_SELECT = false;
$DEBUG_SELECT_MULTIPLE = false;
$DEBUG_INSERT = false;
$DEBUG_UPDATE = false;
$DEBUG_DELETE = false;


$base = 'b2-gp25';
$host = 'localhost';
$name = 'b2-gp25';
$pass = 'zB&6TtAqR7oP';

date_default_timezone_set('Europe/Paris');

try{
    $bdd = new PDO("mysql:host=$host;dbname=$base", $name, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch(PDOException $ex)
{
    //die('Erreur de connexion à la base de donnée :'.$ex->getMessage());
}

function get_head(){
    include 'pages/includes/head.php';
}

function get_header(){
    include 'pages/includes/header.php';
}

function get_footer(){
    include 'pages/includes/footer.php';
}


function get_results($requete){
    global $bdd, $DEBUG_SELECT_MULTIPLE;
    if($DEBUG_SELECT_MULTIPLE) var_dump($requete);
    $requete = $bdd->query($requete);
    if($DEBUG_SELECT_MULTIPLE) var_dump($requete);
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function get_result($requete){
    global $bdd, $DEBUG_SELECT;
    if($DEBUG_SELECT) var_dump($requete);
    $requete = $bdd->query($requete);
    if($DEBUG_SELECT) var_dump($requete);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function set_insert($table, $values, $return = null, $returnId = null){
    global $bdd, $DEBUG_INSERT;

    $requete = "INSERT INTO ".$table."(";
    $i=0;
    foreach(array_keys($values) as $array){
        if($i>0) $requete .= ", ";
        $requete .= $array;
        $i++;
    }
    $requete .= ") VALUES(";
    $i=0;
    foreach(array_keys($values) as $array){
        if($i>0) $requete .= ", ";
        $requete .= ":".$array;
        $i++;
    }
    $requete .= ")";
    $q = $bdd->prepare($requete);

    foreach($values as $key=>$array)
    {
        $q->bindValue(':'.$key, $array, PDO::PARAM_STR);
    }
    
    if($DEBUG_INSERT) var_dump($requete);
    if($return == 1){
        if($q->execute()){
            if($DEBUG_INSERT) var_dump($q->errorInfo());
            if($returnId) $_SESSION['lastInsertId'] = $bdd->lastInsertId();
            return true;
        }else{
            if($DEBUG_INSERT) var_dump($q->errorInfo());
            return false;
        }
    }
    else{
        $q->execute();
        if($returnId) $_SESSION['lastInsertId'] = $bdd->lastInsertId();
        if($DEBUG_INSERT) var_dump($q->errorInfo());
    }
}

function set_update($table, $values, $id, $return = null){
    global $bdd, $DEBUG_UPDATE;
    
    $requete = "UPDATE ".$table." SET ";
    $i=0;
    foreach($values as $key=>$array){
        if((isset($key) && isset($array)) || (isset($key) && $array == NULL)){
            if($i>0) $requete .= ", ";
            $requete .= $key.'=:'.$key;
            $i++;
        }
    }
    $requete .= " WHERE ".$id;

    $q = $bdd->prepare($requete);
    foreach($values as $key=>$array)
    {
        if((isset($key) && isset($array)) || (isset($key) && $array == NULL)) $q->bindValue(':'.$key, $array, PDO::PARAM_STR);
    }
    
    if($DEBUG_UPDATE) var_dump($requete);
    if($return == 1){
        if($q->execute()){
            if($DEBUG_UPDATE) var_dump($q->errorInfo());
            return true;
        }else{
            if($DEBUG_UPDATE) var_dump($q->errorInfo());
            return false;
        }
    }
    else{
        $q->execute();
        if($DEBUG_UPDATE) var_dump($q->errorInfo());
    }
}

function set_delete($table, $values, $return){
    global $bdd, $DEBUG_DELETE;
    $requete = "DELETE FROM ".$table;
    $requete .= " WHERE ".$values;
    $q = $bdd->prepare($requete);

    if($DEBUG_DELETE) var_dump($requete);
    if($return == 1){
        if($q->execute()){
            if($DEBUG_DELETE) var_dump($q->errorInfo());
            return true;
        }else{
            if($DEBUG_DELETE) var_dump($q->errorInfo());
            return false;
        }
    }
    else{
        if($DEBUG_DELETE) var_dump($q->errorInfo());
        $q->execute();
    }
}


include(URLSITEABS."core/class.blog.php");
include(URLSITEABS."core/class.client.php");
include(URLSITEABS."core/class.contenu.php");
include(URLSITEABS."core/class.faq.php");
include(URLSITEABS."core/class.imprimante.php");
include(URLSITEABS."core/class.module.php");
include(URLSITEABS."core/class.pages.php");
include(URLSITEABS."core/class.panier.php");
include(URLSITEABS."core/class.produit.php");
include(URLSITEABS."core/class.stock.php");
include(URLSITEABS."core/class.settings.php");
include(URLSITEABS."core/class.tools.php");
include(URLSITEABS."core/class.url.php");
include(URLSITEABS."lib/phpmailer/PHPMailerAutoload.php");


$error_message = "";
$Blog = new Blog();
$Client = new Client();
$Contenu = new Contenu();
$Faq = new Faq();
$Imprimante = new Imprimante();
$Module = new Module();
$Pages = new Pages();
$Panier = new Panier();
$Produit = new Produit();
$Settings = new Settings();
$Stock = new Stock();
$Tools = new Tools();
$Url = new Url();

$lstSettings = get_results("SELECT * FROM admin_settings ");

foreach($lstSettings as $data){
    if(strstr($data['value'], "URLSITEWEB.")) $data['value'] = str_replace("URLSITEWEB.", URLSITEWEB, $data['value']);
    define($data['identity'], $data['value']);
}
unset($lstSettings);
unset($data);

 ?>