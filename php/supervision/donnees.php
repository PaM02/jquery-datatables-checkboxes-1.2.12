<?php

//fetch.php

include('../bdd.php');

$column = array("id", "donnees");

$query = "SELECT * FROM donnees_superviseur_compteur_monophase ";

if(isset($_POST["search"]["value"])){
		$query .= 'WHERE donnees LIKE "%'.$_POST["search"]["value"].'%"';
}

if(isset($_POST["order"])){

 		$query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';

}
else{

 		$query .= 'ORDER BY id ASC ';

}
$query1 = '';

if($_POST["length"] != -1){

   		$query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $bdd->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $bdd->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row){

	$sub_array = array();
	$sub_array[] = $row['id'];
	$sub_array[] = $row['donnees'];
	
	$data[] = $sub_array;
}

function count_all_data($bdd){

	$query = "SELECT * FROM donnees_superviseur_compteur_monophase";
	$statement = $bdd->prepare($query);
	$statement->execute();

	return $statement->rowCount();
}

$output = array(
		'draw'   => intval($_POST['draw']),
		'recordsTotal' => count_all_data($bdd),
		'recordsFiltered' => $number_filter_row,
		'data'   => $data
);

echo json_encode($output);

?>
