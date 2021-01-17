<?php 

include "data1.php";

$request = 0;

if(isset($_POST['request'])){
	$request = $_POST['request'];
}

// Fetch state list by countryid
if($request == 1){
	$equipid = $_POST['equipid'];

	$stmt = $pdo->prepare("SELECT * FROM models WHERE equipment_name=:equipment_name ORDER BY model_id");
	$stmt->bindParam(':equipment_name',$equipid, PDO::PARAM_STR);

	$stmt->execute();
	$modelList = $stmt->fetchAll();

	$response = array();
	foreach($modelList as $model){
		$response[] = array(
				"id" => $model['model_no'],
				"name" => $model['model_no']
			);
	}

	echo json_encode($response);
	exit;
}

// Fetch city list by stateid
/*if($request == 2){
	$stateid = $_POST['stateid'];

	$stmt = $conn->prepare("SELECT * FROM cities WHERE state=:state ORDER BY name");
	$stmt->bindValue(':state', (int)$stateid, PDO::PARAM_INT);

	$stmt->execute();
	$statesList = $stmt->fetchAll();

	$response = array();
	foreach($statesList as $state){
		$response[] = array(
				"id" => $state['id'],
				"name" => $state['name']
			);
	}

	echo json_encode($response);
	exit;
}*/