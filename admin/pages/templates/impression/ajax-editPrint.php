<?php
include $_SERVER['DOCUMENT_ROOT'].'/parametres/constante.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/parametres/constante.php';

$idPrint = $Tools->data_secure($_POST['idPrint']);
$values = [];
if(isset($_POST['designation'])) $values += ['designation' => $Tools->data_secure($_POST['designation'])];
if(isset($_POST['poids'])) $values += ['poids' => $Tools->data_secure($_POST['poids'])];
if(isset($_POST['temps_impression'])) $values += ['temps_impression' => $Tools->data_secure($_POST['temps_impression'])];
if(isset($_POST['idColor'])){
    $values += ['id_couleur' => $Tools->data_secure($_POST['idColor'])];
    $filament = $Imprimante->getFilament('id = "'.$Tools->data_secure($_POST['idColor']).'"');
    $values += ['prix_couleur' => $filament['prix']];
}
if(isset($_POST['personnalisation'])) $values += ['personnalisation' => $Tools->data_secure($_POST['personnalisation'])];
if(isset($_POST['notes'])) $values += ['notes' => $Tools->data_secure($_POST['notes'])];

if (isset($_POST['nombre_pieces_plateau'])) $values += ['nombre_pieces_plateau' => $Tools->data_secure($_POST['nombre_pieces_plateau'])];
echo "ok";
if($Imprimante->setUpdatePlanning($idPrint, $values))
    $Admin->addEditionHistoric("programme", $idPrint, "modification", 1);
else    
    $Admin->addEditionHistoric("programme", $idPrint, "modification", 0);
echo "ok";

?>