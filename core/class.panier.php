<?php

class Panier{
    
    function addPanier($idProduit, $quantite, $idColor, $personnalisation){
        if(!isset($_SESSION['idPanier']) || !$_SESSION['idPanier']){
            $this->checkPanier();
        }
        $idPanier = $_SESSION['idPanier'];
        $presenceProduit = $this->getPanierProduit('id_panier = "'.$idPanier.'" AND id_produit = "'.$idProduit.'" AND id_color = "'.$idColor.'" AND personnalisation = "'.$personnalisation.'"');
        
        if($presenceProduit){
            $quantiteAdd = $presenceProduit['quantite']+$quantite;
            $values = array(
                'quantite' => $quantiteAdd
            );
            
            if(set_update("panier_produit", $values, 'id = "'.$presenceProduit['id'].'"', 1)){
                $this->updateDateEdit($_SESSION['idPanier']);
                return true;
            }else
                return false;
        }else{
            $values = array(
                'id_panier' => $idPanier,
                'id_produit' => $idProduit,
                'quantite' => $quantite,
                'id_color' => $idColor,
                'personnalisation' => $personnalisation
            );
            
            if(set_insert("panier_produit", $values, 1)){
                $this->updateDateEdit($_SESSION['idPanier']);
                return true;
            }else
                return false;
        }
        
    }
    
    
    function checkPanier(){
        $ipAdresse = $_SERVER['REMOTE_ADDR'];
        $idSession = session_id();
        
        $panierLocal = $this->getPanier("adresse_ip = '".$ipAdresse."' AND session_id = '".$idSession."'");
        if($panierLocal){                                                       //Panier avec id appareil client
            if(isset($_SESSION['idUser']) && $_SESSION['idUser'] && $panierLocal['id_client'] == NULL){
                $idUser = $_SESSION['idUser'];
                $this->updateDataPanier($panierLocal['id'], $idUser);
            }
            $_SESSION['idPanier'] = $panierLocal['id'];
        }else{
            if(isset($_SESSION['idUser']) && $_SESSION['idUser']){              //Panier avec id client
                $idUser = $_SESSION['idUser'];
                $panierIdUser = $this->getPanier("id_client='".$idUser."' ORDER BY id DESC");
                if($panierIdUser)   $_SESSION['idPanier'] = $panierIdUser['id'];
                else{                                                          //Création d'un panier avec id client
                    $request = "ipAdresse = '".$ipAdresse."' AND session_id = '".$idSession."' AND id_client = '".$_SESSION['idUser']."'";
                    $dataInsert = array(
                        'adresse_ip' => $ipAdresse,
                        'session_id' => $idSession,
                        'id_client' => $_SESSION['idUser'],
                        'date_creation' => date('Y-m-d H:i:s')
                    );
                    set_insert("panier", $dataInsert, null);
                    $_SESSION['idPanier'] = $this->getPanier("adresse_ip = '".$ipAdresse."' AND session_id = '".$idSession."' AND id_client = '".$idUser."'")['id'];
                }
            }else{                                                              //Création de panier avec infos appareil client
                $dataInsert = array(
                    'adresse_ip' => $ipAdresse,
                    'session_id' => $idSession,
                    'date_creation' => date('Y-m-d H:i:s')
                );
                set_insert("panier", $dataInsert, null);
                $_SESSION['idPanier'] = $this->getPanier("adresse_ip = '".$ipAdresse."' AND session_id = '".$idSession."'")['id'];
            }
        }
    }
    
    
    function getPanier($where = null){
        $requete = "SELECT * FROM panier WHERE ".$where;
        return get_result($requete);
    }
    
    function updateDataPanier($idPanier, $idUser){
        $values = array(
          'id_client' => $idUser
        );
        set_update("panier", $values, "id='".$idPanier."'", null);
    }
    
    function getProduitPanierWithNamePicture($idPanier){
        return get_results("SELECT panier_produit.*, nom, prix, image_principale, image, identifiant, id_tva FROM panier_produit, produit WHERE id_panier = '".$idPanier."' AND id_produit = `produit`.`id`");
    }
    
    function getProduitPanierFull($idPanier){
        return get_results("SELECT `produit`.*, `panier_produit`.*, `panier_produit`.`id` AS id_ligne  FROM panier_produit, produit WHERE id_panier = '".$idPanier."' AND id_produit = `produit`.`id`");
    }
    
    function updateDateEdit($idPanier){
        $values = array(
          'date_modification' => date('Y-m-d H:i:s')
        );
        set_update("panier", $values, "id='".$idPanier."'", null);
    }
    
    
    
    /******************************* GESTION PANIER *******************************/
    
    function getLstPanier($where = null){
        $request = "SELECT * FROM panier ";
        if($where) $request .= " WHERE ".$where;
        return get_results($request);
    }
    
    
    /******************************* GESTION PANIER PRODUIT *******************************/
    
    function setAddPanierProduit($values){
        return set_insert("panier_produit", $values, 1);
    }

    function setUpdatePanierProduit($values, $where){
        return set_update("panier_produit", $values, $where, 1);
    }

    function setDeletePanierProduit($id){
        return set_delete("panier_produit", "id='".$id."'", 1);
    }
    
    
    function getPanierProduit($where = null){
        $requete = "SELECT * FROM panier_produit ";
        if($where) $requete .= " WHERE ".$where;
        return get_result($requete);
    }
    
    function getLstPanierProduit($where = null){
        $requete = "SELECT * FROM panier_produit ";
        if($where) $requete .= " WHERE ".$where;
        return get_results($requete);
    }
    
    
    
}

