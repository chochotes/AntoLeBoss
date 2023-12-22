<?php

include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include URLADMIN.'parametres/constante.php';
$Tools->log_account_admin();

$idPrint = $Tools->data_secure($_POST['idPrint']);
$idPrinter = $Tools->data_secure($_POST['idPrinter']);
$timing = $Tools->data_secure($_POST['timing']);
$poids_filament = $Tools->data_secure($_POST['poidsFilament']);

$ordrePrecedent = null;
if(isset($_POST['ordrePrecedent']) && $_POST['ordrePrecedent'])
    $ordrePrecedent = $Tools->data_secure($_POST['ordrePrecedent']);
    
$values = [];

if($ordrePrecedent){
    $values += ['ordre' => $ordrePrecedent];
    $values += ['ordre_precedent' => NULL];
}else{
    $maxOrdre = $Imprimante->getMaxAttente($idPrinter, "statut = 'attente'")['maxOrdre'];
    $maxOrdre++;
    $values += ['ordre' => $maxOrdre];
}

$values += ['statut' => "attente"];

$Imprimante->setUpdatePlanning($idPrint, $values);






$values = [];
$values += ['statut' => "echec"];
$values += ['temps_passe' => $timing];
$values += ['fin' => date('Y-m-d H:i:s')];

$planning = $Imprimante->getImpression("id_planning = '".$idPrint."' AND fin is NULL AND statut = 'encours' ORDER BY id DESC");
$Imprimante->setUpdateImpression($planning['id'], $values);

//Mise à jour du stock
$values = [];
$planning = $Imprimante->getPlanning('id = "' . $idPrint . '"');
$id_filament = $planning['id_couleur'];
$poids = $planning['poids'];
$filament_stock = $Imprimante->getStock('id_filament = "' . $id_filament . '"');
$values['stock'] = $filament_stock['stock'] - $poids_filament;
$Imprimante->setUpdateStock('id_filament = "' . $id_filament . '"', $values);


?>