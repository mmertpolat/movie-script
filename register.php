<?php
include("config.php");
$name = strip_tags($_POST['name']);
$email = strip_tags($_POST['email']);
$password = $_POST['password'];
$passwordconfirm = $_POST['passwordconfirm'];

// check email is already used

			$stmt = $db->prepare("SELECT email FROM uyeler WHERE email=:email");
			$stmt->execute(array(':email'=>$email));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

// check email is already used

if($row['email'] != $email){

$query = $db->prepare("INSERT INTO uyeler SET
name = ?,
email = ?,
password = ?");
$insert = $query->execute(array(
     $name, $email, $password
));
if ( $insert ){
    $last_id = $db->lastInsertId();
    print "insert işlemi başarılı!";
    echo json_encode(array("statusCode"=>1));
}

} elseif($row['email'] == $email) {
	echo json_encode(array("statusCode"=>2));
} else {
	echo json_encode(array("statusCode"=>3));
}

?>