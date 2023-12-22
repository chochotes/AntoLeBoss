<?php
include('parametres/constante.php');
$link = 'pages/templates/';

$dataPage = $Tools->data_secure($_GET['page']);
$url = $Tools->data_secure($_GET['url']);
$identifiant = $Tools->data_secure($_GET['identifiant']);
$redirection = $Pages->getRedirection("url = '".$url."' AND statut = 1");


if(MAINTENANCEFRONTMODE == 1){
    include('maintenance/index.html');
}else{
    if($redirection){
        $Tools->redirection(URLSITEWEB.$redirection['redirection']);
    }else{
        $data_page = $Pages->getPages("identifiant='".$url."'");
        if(!$data_page){
            if(strstr($url, "produit")){
                $dataProduit = $Produit->getProduitWithIdentifiant($identifiant);
                $data_page = $dataProduit;
                $data_page['file'] = 'produit';
                $data_page['title'] = $dataProduit['seo_nom'];
                $data_page['meta_titre'] = $dataProduit['seo_nom'];
                $data_page['meta_description'] = $dataProduit['seo_description'];
                $data_page['meta_image'] = URLSITEWEB.$dataProduit['image_principale'];
                $data_page['meta_url'] = $dataProduit['meta_url'];
                $data_page['meta_img_type'] = $dataProduit['meta_img_type'];
                $data_page['meta_img_alt'] = $dataProduit['seo_nom'];
                $data_page['meta_keywords'] = $dataProduit['seo_meta'];
            }elseif(strstr($url, "catalogue")){ 
                $categorie = $Produit->getCategorie('identifiant = "'.$Tools->data_secure($identifiant).'"');
                $data_page['file'] = 'catalogue';
                
                if($categorie['seo_nom']){
                    $data_page['meta_titre'] = $categorie['seo_nom'];
                    $data_page['title'] = $categorie['seo_nom'];
                }else{
                    $data_page['meta_titre'] = $categorie['nom']." - ".NOMSITE;
                    $data_page['title'] = $categorie['nom']." - ".NOMSITE;
                }
                
                
                $data_page['meta_description'] = $categorie['seo_description'];
                $data_page['meta_img_alt'] = $categorie['seo_nom'];
                $data_page['meta_keywords'] = $categorie['seo_meta'];
            }elseif(strstr($url, "blog")){
                $data_page = $Blog->getBlog('identifiant = "'.$Tools->data_secure($identifiant).'"');
                $data_page['file'] = 'post';
            }
        }

        if(isset($data_page) && $data_page){
            foreach ($data_page as $key => $value) {
                $content = str_replace("[[NOMSITE]]", BRANDNAME, $value);
                $content = str_replace("[[URLSITEWEB]]", URLSITEWEB, $content);
                $data_page[$key] = $content;
            }
            $_SESSION['data_page'] = $data_page;

            $_SESSION['title'] = $data_page['title'];
            $_SESSION['meta_titre'] = $data_page['meta_titre'];
            $_SESSION['meta_description'] = $data_page['meta_description'];
            $_SESSION['meta_image'] = $data_page['meta_image'];
            $_SESSION['meta_url'] = $data_page['meta_url'];
            $_SESSION['meta_img_type'] = $data_page['meta_img_type'];
            $_SESSION['meta_img_alt'] = $data_page['meta_img_alt'];
            $_SESSION['meta_keywords'] = $data_page['meta_keywords'];

            if(!include($link.$data_page['file'].'.php'))
                    $Tools->redirection(URLSITEWEB.'404');
        }else
            $Tools->redirection(URLSITEWEB);//Ajouter une info dans les logs pour avoir une trace de l'erreur
    }
}

 ?>