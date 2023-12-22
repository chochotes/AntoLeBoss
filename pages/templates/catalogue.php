<?php
$categorie = "";

if(isset($_POST['search']) && $_POST['search']){
    $search = $Tools->data_secure($_POST['search']);
    $searchSql = " nom like '%".$search."%' OR ".
        "description like '%".$search."%' OR".
        " nom like '%".strtolower($search)."%' OR ".
        "description like '%".strtolower($search)."%' OR".
        " nom like '%".strtoupper($search)."%' OR ".
        "description like '%".strtoupper($search)."%'";
}

if(isset($_GET['identifiant']) && $_GET['identifiant']){
    $categorie = $Produit->getCategorie('identifiant = "'.$Tools->data_secure($_GET['identifiant']).'"');
    if($categorie && $categorie['statut'] == 1)
        if($searchSql)
            $lstProduit = $Produit->getLstProduitOnline("categorie LIKE '%;".$categorie['id'].";%' AND ( ".$searchSql." )");
        else
            $lstProduit = $Produit->getLstProduitOnline("categorie LIKE '%;".$categorie['id'].";%'");
    else
        $Tools->redirection(URLSITEWEB.'catalogue/');
}else
    if($searchSql)
        $lstProduit = $Produit->getLstProduitOnline($searchSql);
    else
        $lstProduit = $Produit->getLstProduitOnline();

$link_header = "catalogue/";
$link_header_to_print = "";

function printCategorieParent($idCategorie){
    global $Produit, $link_header, $link_header_to_print;
    $categorieParent = $Produit->getCategorie("id='".$idCategorie."'");
    $link_header_to_print = '<li><a href="'.$link_header.$categorieParent['identifiant'].'/">'.$categorieParent['nom'].'</a></li>'.$link_header_to_print;
    if($categorieParent['id_parent']) printCategorieParent($categorieParent['id_parent']);
}

get_head();
get_header();

?>

<div class="breadcrumb-area pt-35 pb-35 bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="<?=$link_header?>">Catalogue</a>
                </li>
                <?php
                if($categorie['id_parent']){
                    printCategorieParent($categorie['id_parent']);
                    echo $link_header_to_print;
                }
                if($categorie) echo '<li class="active">'.$categorie['nom'].'</li>';
                ?>
            </ul>
        </div>
    </div>
</div>
<div class="shop-area pt-5 pb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <?php if($search) : ?>
                <div class="col-12">
                    <h2 class="mb-1">Votre recherche : <?=$search?></h2>
                </div>
            <?php endif; ?>
            <div class="col-lg-9 pt-5">
                <div class="shop-top-bar">
                    <div class="select-shoing-wrap">
                        <div class="shop-select">
                            <select>
                                <option value="">Prix - à +</option>
                                <option value="">Prix + à -</option>
                                <option value="">Nom A à Z</option>
                                <option value="">Nom Z à A</option>
                            </select>
                        </div>
                        <?php $nb_produit = count($lstProduit); ?>
                        <p>Produits <?php if($nb_produit>=1) echo "1";?> à <?=$nb_produit?></p>
                    </div>
                </div>
                <div class="shop-bottom-area mt-35">
                    <div class="tab-content jump">
                        <div id="shop-1" class="tab-pane active">
                            <div class="row ht-products">
                                <?php
                                foreach($lstProduit as $dataProduit){
                                    $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
                                    $Produit->printProduitGrid(false, $dataProduit['id'], $dataProduit['nom'], $dataProduit['identifiant'], $dataProduit['image_principale'], $dataProduit['prix'], $promotion, $dataProduit['id_tva']);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 pt-5">
                <div class="sidebar-style mr-30">
                    <div class="sidebar-widget">
                        <h4 class="pro-sidebar-title">Rechercher </h4>
                        <div class="pro-sidebar-search mb-50 mt-25">
                            <form class="pro-sidebar-search-form" action="" method="POST">
                                <input type="text" name="search" placeholder="Votre recherche" <?php if($search) echo 'value="'.$search.'"';?>>
                                <button>
                                    <i class="sli sli-magnifier"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>