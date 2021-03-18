<?php 

include('./db.php');

if(isset($_GET['maker_id'])) {
    $getData = $pdo->prepare("SELECT * from car_model where car_maker_id =  " . $_GET['maker_id']);
    $getData->execute();
    $cars = $getData->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($cars);
} else {
    echo json_encode([]);
}

?>
