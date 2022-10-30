<?php

//fetch.php

include('../bdd.php');

$column = array("id_client","id_prix","nom_client","compteur_no","typeCompteur");

$query = "SELECT id_client,id_prix,nom_client,compteur_no,typeCompteur
			FROM comptes
			";

if(isset($_POST["search"]["value"])){
		$query .= '
		WHERE nom_client LIKE "%'.$_POST["search"]["value"].'%" 
			OR compteur_no LIKE "%'.$_POST["search"]["value"].'%" 
			OR id_prix LIKE "%'.$_POST["search"]["value"].'%" 
			OR typeCompteur LIKE "%'.$_POST["search"]["value"].'%"  
			
		';
}


$statement = $bdd->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $bdd->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row){

	$sub_array = array();
	$sub_array[] = $row['id_client'];
	$sub_array[] = $row['id_prix'];
	$sub_array[] = $row['nom_client'];
	$sub_array[] = $row['compteur_no'];
	$sub_array[] = $row['typeCompteur'];
	
	$data[] = $sub_array;
}

function count_all_data($bdd){

	$query = "SELECT id_client,id_prix,nom_client,compteur_no,typeCompteur
			FROM comptes
				";
	$statement = $bdd->prepare($query);
	$statement->execute();

	return $statement->rowCount();
}

$output = array(
		
		'data'=> $data
);

echo json_encode($output);

?>
