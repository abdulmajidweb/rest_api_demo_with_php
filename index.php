<?php


header("content-type: application/json");
$request = $_SERVER["REQUEST_METHOD"];

switch ($request) {
	case 'GET':
		getmethod();
		break;

	case 'POST':
		$data = json_decode(file_get_contents("php://input"), true);
		postmethod($data);
		break;

	case 'PUT':
		$data = json_decode(file_get_contents("php://input"), true);
		putmethod($data);
		break;

	case 'DELETE':
		$data = json_decode(file_get_contents("php://input"), true);
		deletemethod($data);
		break;
	
	default:
		echo '{"Name": "Data not found"}';
		break;
}

//GET method ***
function getmethod(){
	include 'db.php';
	$sql = "SELECT * FROM user_details";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$rows = array();
		foreach ($result as $key => $value) {
			$rows['result'][] = $value;
		}
		echo json_encode($rows);
	}

}

//POST method ***
function postmethod($data){
	include 'db.php';
	$name = $data['name'];
	$email = $data['email'];
	$sql = "INSERT INTO user_details(name, email, created_at) VALUES('$name', '$email', NOW())";
	$result = $conn->query($sql);

	if ($result === TRUE) {
		echo '{"Message": "Data inserted!"}';
	} else {
		echo '{"Message": "Data not inserted!"}';
	}
}

//PUT method ***
function putmethod($data){
	include 'db.php';
	$id = $data['id'];
	$name = $data['name'];
	$email = $data['email'];
	$sql = "UPDATE user_details SET name='$name', email='$email' WHERE id='$id'";
	$result = $conn->query($sql);

	if ($result === TRUE) {
		echo '{"Message": "Data updated!"}';
	} else {
		echo '{"Message": "Data not updated!"}';
	}
}

//DELETE method ***
function deletemethod($data){
	include 'db.php';
	$id = $data['id'];
	$sql = "DELETE FROM user_details WHERE id='$id'";
	$result = $conn->query($sql);

	if ($result === TRUE) {
		echo '{"Message": "Data deleted!"}';
	} else {
		echo '{"Message": "Data not deleted!"}';
	}
}
