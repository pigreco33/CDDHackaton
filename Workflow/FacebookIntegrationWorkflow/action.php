<?php
include_once 'init.php';
include 'utils.php';

$id = $_REQUEST['id'];
$action = $_REQUEST['do'];


switch ($action) {
	
	case 'approva':
		$votazioni = $db->votazioni;
		$votazioni->update(array('_id'=>$id),array('$set'=>array('approved'=>true, 'published'=>false)));
	break;

	case 'ritira':
		$votazioni = $db->votazioni;
		$result = $votazioni->update(array('_id'=>$id),array('$set'=>array('approved'=>false)));
		break;

	default:
		echo 'error';
	break;
	
}
header('Content-Type: application/json');
$result = $votazioni->findOne(array('_id'=>$id));
$resultTableRow = formatRow($id, $result);
echo json_encode($resultTableRow);
