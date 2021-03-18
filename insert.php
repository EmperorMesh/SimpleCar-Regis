<?php include "db.php"; ?>
<?php
if (isset($_POST['firstname'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $bank = $_POST['bank'];
  $accountname = $_POST['accountname'];
  $accountnumber = $_POST['accountnumber'];
}

$sql = "INSERT INTO banking (firstname, lastname, email,bank,accountname,accountnumber)
    VALUES (:firstname,:lastname,:email,:bank,:accountname,:accountnumber)";


$inserts = $pdo->prepare($sql);
$inserts->bindParam(':firstname', $firstname);
$inserts->bindParam(':lastname', $lastname);
$inserts->bindParam(':email', $email);
$inserts->bindParam(':bank', $bank);
$inserts->bindParam(':accountname', $accountname);
$inserts->bindParam(':accountnumber', $accountnumber, PDO::PARAM_INT);
$inserts->execute();


if ($inserts->execute()) {
  $status = "sucessfull";
} else {
  $status = "Error";
}

//get id

$sql = $pdo->prepare("SELECT ID FROM banking");
$sql->execute();
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
  $the_id = $row['ID'];
}
echo json_encode([
  "id" => $the_id,
  "success" => $status
]);

?>