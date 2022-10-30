<?php

//action.php

include('../bdd.php');

if($_POST['action'] == 'edit'){

		$data = array(

			':idDCU'  => $_POST['idDCU'],
		  	':nomDCU'  => $_POST['nomDCU'],
		  	':localisation'   => $_POST['localisation'],
			':date_de_demarrage'    => $_POST['date_de_demarrage'],
			':etat'    => $_POST['etat']
		);

		$query = "
			UPDATE gestion_dcu
			SET nomDCU = :nomDCU, 
			localisation = :localisation, 
			date_de_demarrage = :date_de_demarrage, 
			etat = :etat
			WHERE idDCU = :idDCU
		";

		$statement = $bdd->prepare($query);
		$statement->execute($data);
		echo json_encode($_POST);
}

if($_POST['action'] == 'delete'){

		$query = "
		DELETE FROM gestion_dcu
		WHERE idDCU = '".$_POST["idDCU"]."'
		";
		$statement = $bdd->prepare($query);
		$statement->execute();
		echo json_encode($_POST);
}


?>