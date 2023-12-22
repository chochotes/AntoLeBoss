<?php

class Produit{
    
    function getLstProduitOnline($where = null, $order = null, $limit = null){
        $dateTime = date('Y-m-d H:i:s');
        $requete = "SELECT * FROM produit WHERE date_visibilite < '".$dateTime."' AND (statut = 1 OR (stock > 0 AND statut = 2))";
        if($where) $requete .= " AND ".$where;
        if($order) $requete .= " ORDER BY ".$order;
        if($limit) $requete .= " LIMIT ".$limit;
        return get_results($requete);
    }
    
    function checkProduitOnline($idProduit){
        $dateTime = date('Y-m-d H:i:s');
        if(get_result("SELECT * FROM produit WHERE id = '".$idProduit."' AND date_visibilite < '".$dateTime."' AND statut <> 0"))
            return true;
        else
            return false;
    }
    
    function checkProduitOnlineBuy($idProduit){
        $dateTime = date('Y-m-d H:i:s');
        return get_result("SELECT * FROM produit WHERE id = '".$idProduit."' AND date_visibilite < '".$dateTime."' AND (statut = 1 OR (stock > 0 AND statut = 2))");
    }
    
    function getLstProduit($where = null){
        $requete = "SELECT * FROM produit";
        if($where) $requete .= " WHERE ".$where;
        return get_results($requete);
    }
    
    function getProduitWhere($where = null){
        $requete = "SELECT * FROM produit";
        if($where) $requete .= " WHERE ".$where;
        return get_result($requete);
    }
    
    function getProduit($where = null){
        $requete = "SELECT * FROM produit";
        if($where) $requete .= " WHERE ".$where;
        return get_result($requete);
    }
    
    function getProduitWithIdentifiant($identifiant){
        $result = get_result("SELECT * FROM produit WHERE identifiant = '".$identifiant."'");
        return $result;
    }
    
    
    function getMinPrice($lstProduit){
        unset($min_price);
        
        foreach($lstProduit as $dataProduit){
            $promotion = $this->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
            if($promotion) $prix = $promotion;
            else $prix = $dataProduit['prix'];
            
            $prix = $this->getPriceWithTva($prix, $dataProduit['id_tva']);
            
            if(!$min_price) $min_price = $prix;
            if($prix < $min_price) $min_price = $prix;
        }
        
        return floor($min_price);
    }
    
    function getMaxPrice($lstProduit){
        unset($max_price);
        
        foreach($lstProduit as $dataProduit){
            $promotion = $this->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
            if($promotion) $prix = $promotion;
            else $prix = $dataProduit['prix'];
            
            $prix = $this->getPriceWithTva($prix, $dataProduit['id_tva']);
            
            if(!$max_price) $max_price = $prix;
            if($prix > $max_price) $max_price = $prix;
        }
        
        return ceil($max_price);
    }
    
    
    function printProduitScroll($idProduit, $name, $identifiant, $price, $pricePromotion, $id_tva){
        $identifiant = "produit/".$identifiant;
        ?>
        <!--Product Start-->
        <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
            <div class="ht-product-inner">
                <div class="ht-product-image-wrap">
                    <a href="<?=$identifiant?>" class="ht-product-image"> <img src="media/icon/product-6.svg" alt="Universal Product Style"> </a>
                    <div class="ht-product-action">
                        <ul>
                            <?php //<li><a href="#"><i class="sli sli-heart"></i><span class="ht-product-action-tooltip">Ajouter à ma liste d'envies</span></a></li> ?>
                            <?php //<li><a href="#"><i class="sli sli-refresh"></i><span class="ht-product-action-tooltip">Comparer</span></a></li> ?>
                            <li><a href="#"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Ajouter au panier</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="ht-product-content">
                    <div class="ht-product-content-inner">
                        <h4 class="ht-product-title"><a href="<?=$identifiant?>"><?=name?></a></h4>
                        <div class="ht-product-price">
                            <?php 
                            if($pricePromotion != false){
                                echo '<span class="new">'.$this->getPriceWithTva($pricePromotion, $id_tva).' €</span>';
                                echo '<span class="old">'.$this->getPriceWithTva($price, $id_tva).' €</span>';
                            }else
                                echo '<span class="new">'.$this->getPriceWithTva($price, $id_tva).' €</span>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Product End-->
        <?php 
    }
    
    function printProduitGrid($home, $idProduit, $name, $identifiant, $image, $price, $pricePromotion, $id_tva){
        $identifiant = "produit/".$identifiant;
        if(!$home) echo '<div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">';
        ?>
        <!--Product Start-->
        <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom <?php if($home) echo 'col-lg-3 col-md-6 col-sm-6 col-12'; ?> mb-30">
            <div class="ht-product-inner">
                <div class="ht-product-image-wrap">
                    <a href="<?=$identifiant?>" class="ht-product-image"> <img src="<?=URLSITEWEB.$image?>" alt="Universal Product Style"> </a>
                    <div class="ht-product-action">
                        <ul>
                            <?php //<li><a href="#"><i class="sli sli-heart"></i><span class="ht-product-action-tooltip">Ajouter à ma liste d'envies</span></a></li> ?>
                            <?php //<li><a href="#"><i class="sli sli-refresh"></i><span class="ht-product-action-tooltip">Comparer</span></a></li> ?>
                            <?php //<li><a href="#"><i class="sli sli-bag"></i><span class="ht-product-action-tooltip">Ajouter au panier</span></a></li> ?>
                        </ul>
                    </div>
                </div>
                <div class="ht-product-content">
                    <div class="ht-product-content-inner">
                        <h4 class="ht-product-title"><a href="<?=$identifiant?>"><?= $name ?></a></h4>
                        <div class="ht-product-price">
                            <?php 
                            if($pricePromotion != false){
                                echo '<span class="new">'.$this->getPriceWithTva($pricePromotion, $id_tva).' €</span>';
                                echo '<span class="old">'.$this->getPriceWithTva($price, $id_tva).' €</span>';
                            }else
                                echo '<span class="new">'.$this->getPriceWithTva($price, $id_tva).' €</span>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Product End-->
        <?php 
        if(!$home) echo '</div>';
    }
    
    function printProduitGridList($idProduit, $name, $identifiant, $image, $price, $pricePromotion, $id_tva){
        $identifiant = "produit/".$identifiant;
        ?>
        <div class="shop-list-wrap shop-list-mrg2 shop-list-mrg-none mb-30">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="product-list-img">
                        <a href="<?=$identifiant?>">
                            <img src="<?=$image?>" alt="Universal Product Style">
                        </a>
                        <div class="product-quickview">
                            <a href="<?=$identifiant?>"><i class="sli sli-magnifier-add"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 align-self-center">
                    <div class="shop-list-content">
                        <h3><a href="<?=$identifiant?>"><?=$name?></a></h3>
                        <p>It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard The standard chunk.</p>
                        <div class="shop-list-price-action-wrap">
                            <div class="shop-list-price-ratting">
                                <div class="ht-product-list-price">
                                    <?php 
                                    if($pricePromotion != false){
                                        echo '<span class="new">'.$this->getPriceWithTva($pricePromotion, $id_tva).' €</span>';
                                        echo '<span class="old">'.$this->getPriceWithTva($price, $id_tva).' €</span>';
                                    }else
                                        echo '<span class="new">'.$this->getPriceWithTva($price, $id_tva).' €</span>';
                                    ?>
                                </div>
                            </div>
                            <div class="ht-product-list-action">
                                <?php //<a class="list-wishlist" title="Ajouter à ma liste d'envies" href="#"><i class="sli sli-heart"></i></a> ?>
                                <a class="list-cart" title="decouvrir" href="<?=URLSITEWEB.$identifiant?>"><i class="sli sli-basket-loaded"></i>Découvrir</a>
                                <?php //<a class="list-refresh" title="Comparer" href="#"><i class="sli sli-refresh"></i></a> ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Product End-->
        <?php 
    }
    
    function getPromotionProduit($idProduit, $prix){
        $dateDay = date('Y-m-d H:i:s');
        $result = get_result("SELECT * FROM produit_promotion WHERE date_debut < '".$dateDay."' AND date_fin > '".$dateDay."' AND id_produit LIKE '%;".$idProduit.";%'");

        if($result){
            if($result['nouveau_prix'])
                $prixPromotion = $result['nouveau_prix'];
            else{
                if($result['type'] == "%") $prixPromotion = $prix-($prix*($result['remise']/100));
                else $prixPromotion = $prix-$result['remise'];
            }
            return $prixPromotion;
        }else
            return false;
    }

    
    /******************************* GESTION CATEGORIE *******************************/
    
    function setAddCategorie($values){
        return set_insert("produit_categorie", $values, 1);
    }

    function setUpdateCategorie($id, $values){
        return set_update("produit_categorie", $values, $id, 1);
    }

    function setDeleteCategorie($id){
        return set_delete("produit_categorie", "id='".$id."'", 1);
    }
    
    function getCategorie($where){
        $request = "SELECT * FROM produit_categorie WHERE ".$where;
        return get_result($request);
    }
    
    function getLstCategorie($where = null){
        $request = "SELECT * FROM produit_categorie ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
    
    function printChildCategorie($id_parent, $niveau = 0, $lstCategorie = null){
        $Tools = new Tools($db);
        if(!$lstCategorie) $lstCategorie = $this->getLstCategorie("id_parent = '".$id_parent."'");
        foreach ($lstCategorie as $dataCategorie) {
            ?>
            <li class="<?php if($niveau) echo "child-".$niveau; ?>">
                <div class="sidebar-widget-list-left">
                    <input type="checkbox" name="<?=$dataCategorie['id']?>" id="<?=$dataCategorie['id']?>" onclick="changeCategorie('<?=$Tools->crypt($dataCategorie['id'], KEY)?>')"><label for="<?=$dataCategorie['id']?>"><?=$dataCategorie['nom']?></label> 
                    <span class="checkmark"></span>
                </div>
            </li>
            <?php
            $lstCategorieEnfant = $this->getLstCategorie("id_parent = '".$dataCategorie['id']."'");
            if($lstCategorieEnfant){
                $this->printChildCategorie($id_parent, $niveau+1, $lstCategorieEnfant);
            }
        }
    }
    
    /******************************* GESTION TVA *******************************/
    
    function setAddTva($values){
        return set_insert("produit_tva", $values, 1);
    }

    function setUpdateTva($id, $values){
        return set_update("produit_tva", $values, $id, 1);
    }

    function setDeleteTva($id){
        return set_delete("produit_tva", "id='".$id."'", 1);
    }
    
    function getTva($where){
        $request = "SELECT * FROM produit_tva WHERE ".$where;
        return get_result($request);
    }
    
    function getLstTva($where = null){
        $request = "SELECT * FROM produit_tva ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
    
    function getPriceWithTva($price, $id_tva){
        $taux = $this->getTva("id='".$id_tva."'")['taux'];
        return number_format($price + ($price*($taux/100)),2);
    }
    
    /******************************* GESTION DES PROMOTIONS *******************************/
    
    function setAddPromotion($values){
        return set_insert("produit_promotion", $values, 1);
    }

    function setUpdatePromotion($id, $values){
        return set_update("produit_promotion", $values, $id, 1);
    }

    function setDeletePromotion($id){
        return set_delete("produit_promotion", "id='".$id."'", 1);
    }
    
    function getPromotion($where){
        $request = "SELECT * FROM produit_promotion WHERE ".$where;
        return get_result($request);
    }
    
    function getLstPromotion($where = null){
        $request = "SELECT * FROM produit_promotion ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
    
    
    /******************************* GESTION DES LIVRAISONS *******************************/
    
    function setAddLivraison($values){
        return set_insert("livraison", $values, 1);
    }

    function setUpdateLivraison($id, $values){
        return set_update("livraison", $values, $id, 1);
    }

    function setDeleteLivraison($id){
        return set_delete("livraison", "id='".$id."'", 1);
    }
    
    function getLivraison($where){
        $request = "SELECT * FROM livraison WHERE ".$where;
        return get_result($request);
    }
    
    function getLstLivraison($where = null){
        $request = "SELECT * FROM livraison ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
}