<?php
$Panier = new Panier();
$Produit = new Produit();

$Panier->checkPanier();

if(isset($_SESSION['idPanier']) && $_SESSION['idPanier']){
    $panierProduct = $Panier->getProduitPanierWithNamePicture($_SESSION['idPanier']);
    foreach($panierProduct as $dataProduit){
        $quantiteTotal += $dataProduit['quantite'];
        $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
        if($promotion != false)
            $prix = $Produit->getPriceWithTva($promotion, $dataProduit['id_tva']);
        else
            $prix = $Produit->getPriceWithTva($dataProduit['prix'], $dataProduit['id_tva']);
        $prixTotal += $dataProduit['quantite']*$prix;
    }
}
$prixTotal = number_format($prixTotal,2);
?>
<body>
    <div class="wrapper">
    <header class="header-area sticky-bar">
        <div class="main-header-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo pt-2">
                            <a href="<?=URLSITEWEB?>">
                                <img src="<?=URLLOGO?>" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7">
                        <div class="main-menu">
                            <nav>
                                <ul>
                                    <li class="angle-shape"><a href="catalogue/fleurs">Fleurs</a>
                                        <ul class="mega-menu">
                                            <li><a class="menu-title" href="catalogue/fleurs/Saison">Saison</a>
                                                <ul>
                                                    <li><a href="catalogue/fleurs/Saison/Hivers">Hivers</a></li>
                                                    <li><a href="catalogue/fleurs/Saison/Ete">Eté</a></li>
                                                    <li><a href="catalogue/fleurs/Saison/Automne">Automne</a></li>
                                                    <li><a href="catalogue/fleurs/Saison/Printemps">Printemps</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="menu-title" href="catalogue/fleurs/Maison">Chez soi</a>
                                                <ul>
                                                    <li><a href="catalogue/fleurs/Maison/exterieur">Fleurs d'extérieurs</a></li>
                                                    <li><a href="catalogue/fleurs/Maison/interieur">Fleurs d'intérieur</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="menu-title" href="catalogue/fleurs/Climat">Climat</a>
                                                <ul>
                                                    <li><a href="catalogue/fleurs/Maison/Chaud">Climat Chaud</a></li>
                                                    <li><a href="catalogue/fleurs/Maison/Froid">Climat Froid</a></li>
                                                    <li><a href="catalogue/fleurs/Maison/Tropicaux">Climat Tropicaux</a></li>
                                                </ul>
                                        </ul>
                                     </li>
                                    <li><a href="blog/">Actualités</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <div class="header-right-wrap pt-40">
                            <div class="header-search">
                                <a class="search-active" href="#"><i class="fas fa-search"></i></a>
                            </div>
                            <div class="cart-wrap">
                                <button class="icon-cart-active">
                                    <span class="cart-price" id="panierTotal_desktop">
                                        <?php if(isset($panierProduct) && $panierProduct) echo $prixTotal.' €'; ?>
                                    </span>
                                    <span class="icon-cart" id="panierNbProduit_desktop">
                                        <i class="fas fa-shopping-basket"></i>
                                        <?php if(isset($panierProduct) && $panierProduct): ?>
                                            <span class="count-style">
                                                <?=$quantiteTotal ?>
                                            </span>
                                        <?php endif; ?>
                                    </span>
                                </button>
                                <div class="shopping-cart-content"  id="panier_desktop">
                                    <div class="shopping-cart-top">
                                        <h4>Panier</h4>
                                        <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                                    </div>
                                    <?php if(isset($panierProduct) && $panierProduct): ?>
                                    <ul>
                                        <?php 
                                        $total = 0;
                                        foreach($panierProduct as $dataProduit){
                                            $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
                                            if($promotion != false)
                                                $prix = $Produit->getPriceWithTva($promotion, $dataProduit['id_tva']);
                                            else
                                                $prix = $Produit->getPriceWithTva($dataProduit['prix'], $dataProduit['id_tva']);
                                            ?>
                                            <li class="single-shopping-cart">
                                                <div class="shopping-cart-img">
                                                    <a href="<?=URLPRODUIT.$dataProduit['identifiant']?>"><img alt="" src="<?=URLSITEWEB.$dataProduit['image_principale']?>"></a>
                                                    <?php /*<div class="item-close">
                                                        <a href="#"><i class="sli sli-close"></i></a>
                                                    </div>*/ ?>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="<?=URLPRODUIT.$dataProduit['identifiant']?>"><?=$dataProduit['nom']?> </a></h4>
                                                    <span><?=$dataProduit['quantite']?> x <?=number_format($prix,2)?> €</span>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                    <div class="shopping-cart-bottom">
                                        <div class="shopping-cart-total">
                                            <h4>Total : <span class="shop-total" id="panierTotalDetail_desktop"><?=$prixTotal?> €</span></h4>
                                        </div>
                                        <div class="shopping-cart-btn btn-hover text-center">
                                            <a class="default-btn" href="panier/">Voir mon panier</a>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <p>Votre panier est vide.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="setting-wrap">
                                <button class="setting-active">
                                    <i class="fas fa-user-alt"></i>
                                </button>
                                <div class="setting-content">
                                    <ul>
                                        <li>
                                            <?php if(isset($_SESSION['logUser']) && $_SESSION['logUser']==true): ?>
                                            <h4><a class="menu-title" href="mon-compte/">Mon compte</a></h4>
                                            <?php else: ?>
                                            <h4><a class="menu-title" href="se-connecter/">Mon compte</a></h4>
                                            <?php endif; ?>
                                            <ul>
                                                <?php if(isset($_SESSION['logUser']) && $_SESSION['logUser']==true): ?>
                                                <li><a href="mon-compte/">Mes commandes</a></li>
                                                <li><a href="mon-compte/">Mes informations</a></li>
                                                <li><a href="se-deconnecter/">Déconnexion</a></li>
                                                <?php else: ?>
                                                <li><a href="se-connecter/">Se connecter / S'inscrire</a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- main-search start -->
            <div class="main-search-active">
                <div class="sidebar-search-icon">
                    <button class="search-close"><span class="sli sli-close"></span></button>
                </div>
                <div class="sidebar-search-input">
                    <form method="POST" action="<?=URLSITEWEB?>catalogue/">
                        <div class="form-search">
                            <input name="search" id="search" class="input-text" placeholder="Rechercher" type="text">
                            <button>
                                <i class="sli sli-magnifier"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="header-small-mobile">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="mobile-logo">
                            <a href="<?=URLSITEWEB?>">
                                <img src="media/logo/3daccess_logo_compress.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="header-right-wrap">
                            <div class="cart-wrap">
                                <button class="icon-cart-active">
                                    <span class="icon-cart">
                                        <i class="sli sli-bag"></i>
                                        <?php if(isset($panierProduct) && $panierProduct): ?>
                                            <span class="count-style" id="panierNbProduit_mobile">
                                                <?=$quantiteTotal ?>
                                            </span>
                                        <?php endif; ?>
                                    </span>
                                    <span class="cart-price" id="panierTotal_mobile">
                                        <?php if(isset($panierProduct) && $panierProduct) echo $prixTotal.' €'; ?>
                                    </span>
                                </button>
                                <div class="shopping-cart-content">
                                    <div class="shopping-cart-top">
                                        <h4>Panier</h4>
                                        <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                                    </div>
                                    <?php if(isset($panierProduct) && $panierProduct): ?>
                                        <ul id="panier_mobile">
                                            <?php 
                                            $total = 0;
                                            foreach($panierProduct as $dataProduit){
                                                $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
                                                if($promotion != false)
                                                    $prix = $Produit->getPriceWithTva($promotion, $dataProduit['id_tva']);
                                                else
                                                    $prix = $Produit->getPriceWithTva($dataProduit['prix'], $dataProduit['id_tva']);
                                                ?>
                                                <li class="single-shopping-cart">
                                                    <div class="shopping-cart-img">
                                                        <a href="<?=URLPRODUIT.$dataProduit['identifiant']?>"><img alt="" src="<?=URLSITEWEB.$dataProduit['image_principale']?>"></a>
                                                        <?php /*<div class="item-close">
                                                            <a href="#"><i class="sli sli-close"></i></a>
                                                        </div>*/ ?>
                                                    </div>
                                                    <div class="shopping-cart-title">
                                                        <h4><a href="<?=URLPRODUIT.$dataProduit['identifiant']?>"><?=$dataProduit['nom']?> </a></h4>
                                                        <span><?=$dataProduit['quantite']?> x <?=number_format($prix,2)?> €</span>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <div class="shopping-cart-bottom">
                                            <div class="shopping-cart-total">
                                                <h4>Total : <span class="shop-total" id="panierTotalDetail_mobile"><?=$prixTotal?> €</span></h4>
                                            </div>
                                            <div class="shopping-cart-btn btn-hover text-center">
                                                <a class="default-btn" href="panier/">Voir mon panier</a>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <p>Votre panier est vide.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="mobile-off-canvas">
                                <a class="mobile-aside-button" href="#"><i class="sli sli-menu"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="mobile-off-canvas-active">
        <a class="mobile-aside-close"><i class="sli sli-close"></i></a>
        <div class="header-mobile-aside-wrap">
            <div class="mobile-search">
                <form class="search-form" action="<?=URLSITEWEB?>catalogue/" method="POST">
                    <input type="text" name="search" placeholder="Rechercher">
                    <button class="button-search"><i class="sli sli-magnifier"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap">
                <!-- mobile menu start -->
                <div class="mobile-navigation">
                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children "><a href="catalogue/fleurs">fleurs</a>
                                <ul class="dropdown">
                                    <li><a class="menu-item-has-children" href="catalogue/fleurs/Saison">Saison</a>
                                        <ul class = "dropdown">
                                            <li><a href="catalogue/fleurs/Saison/Hivers">Hivers</a></li>
                                            <li><a href="catalogue/fleurs/Saison/Ete">Eté</a></li>
                                            <li><a href="catalogue/fleurs/Saison/Automne">Automne</a></li>
                                            <li><a href="catalogue/fleurs/Saison/Printemps">Printemps</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="menu-item-has-children" href="catalogue/fleurs/Maison">Chez soi</a>
                                        <ulclass = "dropdown">
                                            <li><a href="catalogue/fleurs/Maison/exterieur">Fleurs d'extérieurs</a></li>
                                            <li><a href="catalogue/fleurs/Maison/interieur">Fleurs d'intérieur</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="menu-item-has-children" href="catalogue/fleurs/Climat">Climat</a>
                                        <ul class = "dropdown">
                                            <li><a href="catalogue/fleurs/Maison/Chaud">Climat Chaud</a></li>
                                            <li><a href="catalogue/fleurs/Maison/Froid">Climat Froid</a></li>
                                            <li><a href="catalogue/fleurs/Maison/Tropicaux">Climat Tropicaux</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class=""><a href="blog/">Actualités</a></li>
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-curr-lang-wrap">
                <div class="single-mobile-curr-lang">
                    <?php if(isset($_SESSION['logUser']) && $_SESSION['logUser']==true): ?>
                        <a class="mobile-account-active" href="mon-compte/">Mon compte <i class="sli sli-arrow-down"></i></a>
                    <?php else: ?>
                        <a class="mobile-account-active" href="se-connecter">Mon compte <i class="sli sli-arrow-down"></i></a>
                    <?php endif; ?>
                    <div class="lang-curr-dropdown account-dropdown-active">
                        <ul>
                            <?php if(isset($_SESSION['logUser']) && $_SESSION['logUser']==true): ?>
                                <li><a href="mon-compte/">Mes commandes</a></li>
                                <li><a href="mon-compte/">Mes informations</a></li>
                                <li><a href="unlog/">Déconnexion</a></li>
                            <?php else: ?>
                                <li><a href="se-connecter/">Se connecter / S'inscrire</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mobile-social-wrap">
                <a class="facebook" href="<?=URLFACEBOOK?>" target="_blank"><i class="sli sli-social-facebook"></i></a>
                <?php //<a class="twitter" href="#"><i class="sli sli-social-twitter"></i></a> ?>
                <a class="instagram" href="<?=URLINSTAGRAM?>" target="_blank"><i class="sli sli-social-instagram"></i></a>
            </div>
        </div>
    </div>