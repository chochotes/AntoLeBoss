<?php
include '../../parametres/constante.php';
$Client = new Client();
$Tools = new Tools();
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center m-3" href="accueil/">
                <div class="sidebar-brand-text"><img src="<?=URLLOGOWHITE?>" alt="" class="w-75"></div>
            </a>

            <!-- Divider -->
            
            <?php if($_SESSION['droit'] == "administrator" || $_SESSION['droit'] == "administrator-developer"){ ?>
                <hr class="sidebar-divider my-0">
                <li class="nav-item <?php if($_SESSION['page'] == 'tableaudebord') echo "active";?>">
                    <a class="nav-link" href="tableaudebord/">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Tableau de bord</span></a>
                </li>
            <?php } ?>
            
            <!-- Divider -->
            
            <hr class="sidebar-divider">
            <?php if($_SESSION['droit'] == "administrator" || $_SESSION['droit'] == "administrator-developer"){ ?>
                <li class="nav-item <?php if($_SESSION['module'] == 'boutique') echo "active";?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-fw fa-shopping-basket"></i>
                        <span>Boutique</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="boutique/panier/">Panier</a>
                            <a class="collapse-item" href="boutique/client/">Client</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            
            <li class="nav-item <?php if($_SESSION['module'] == 'produit') echo "active";?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Produit</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="produit/configuration/">Configuration</a>
                        <a class="collapse-item" href="produit/categorie/">Catégorie</a>
                        <?php if($_SESSION['droit'] == "administrator"){ ?>
                            <a class="collapse-item" href="produit/tva/">Tva</a>
                            <a class="collapse-item" href="produit/promotion/">Promotion</a>
                            <a class="collapse-item" href="produit/livraison/">Livraison</a>
                        <?php } ?>
                    </div>
                </div>
            </li>

                        
            <?php if($_SESSION['droit'] == "administrator" || $_SESSION['droit'] == "administrator-developer"){ ?>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <li class="nav-item <?php if($_SESSION['module'] == 'impression') echo "active";?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                        aria-expanded="true" aria-controls="collapseFour">
                        <i class="fas fa-fw fa-print"></i>
                        <span>Impression</span>
                    </a>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="impression/imprimante/">Imprimante</a>
                            <a class="collapse-item" href="impression/filament/">Filament</a>
                            <a class="collapse-item" href="impression/stock/">Stock</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            
            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item <?php if($_SESSION['module'] == 'contenu') echo "active";?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight"
                    aria-expanded="true" aria-controls="collapseEight">
                    <i class="fas fa-align-justify"></i>
                    <span>Contenu</span>
                </a>
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="contenu/texte/">Texte</a>
                        <a class="collapse-item" href="contenu/blog/">Blog</a>
                        <a class="collapse-item" href="contenu/faq/">Faq</a>
                    </div>
                </div>
            </li>
            
            <li class="nav-item <?php if($_SESSION['module'] == 'configuration') echo "active";?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                    aria-expanded="true" aria-controls="collapseFive">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Configuration</span>
                </a>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="configuration/redirection/">Redirection</a>
                        <a class="collapse-item" href="configuration/page/">Page</a>
                        <a class="collapse-item" href="configuration/parametre/">Paramètre</a>
                        <a class="collapse-item" href="configuration/historique/">Historique</a>
                    </div>
                </div>
            </li>
            
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link" href="<?=URLSITEWEB?>" target="_blank">
                    <i class="fas fa-arrow-left"></i>
                    <span>Site</span></a>
            </li>
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php if(MAINTENANCEBOMODE == 1 ): ?>
                        <div class="alert alert-danger show w-100 mb-0" role="alert">
                            <?=MAINTENANCEBOMESSAGE?>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['error_message']) && isset($_SESSION['error_color'])): ?>
                        <div class="alert alert-<?=$_SESSION['error_color']?> alert-dismissible fade show w-100 mb-0" role="alert">
                            <?=$_SESSION['error_message']?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        unset($_SESSION['error_message']);
                        unset($_SESSION['error_color']);
                    endif; ?>
                    <ul class="navbar-nav ml-auto">
                        <?php if($_SESSION['droit'] == "administrator"){
                        ?>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Messages
                                </h6>
                                <a class="dropdown-item text-center small text-gray-500" href="<?=URLADMIN?>contact/contact/">Voir tous les messages</a>
                            </div>
                        </li>
                        <?php } ?>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION['adminPrenom']." ".$_SESSION['adminNom']?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout/">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-5 col-12">
                                    <h1 class="h3 mb-0 text-gray-800"><?=$_SESSION['name_page']?></h1>
                                </div>
                                <div class="col-md-4 col-12">
                                </div>
                                <div class="col-md-3 col-12 text-right">
                                    <?php
                                    if(isset($_SESSION['module']) && $_GET['module']) $refresh = $_SESSION['module'].'/'.$_SESSION['page'];
                                    else $refresh = $_SESSION['page'];

                                    if(isset($_GET['id']) && $_GET['id'] && $_GET['id'] && $_SESSION['action'] == "edit") $refresh .= "-edit-".$_GET['id'];
                                    ?>
                                    <a href="<?=$refresh?>" class="btn btn-primary"><i class="fas fa-download fa-sync-alt text-white-50"></i> Actualiser</a>
                                </div>
                            </div>
                        </div>
                    </div>