<?php include "db.php"?>
<!DOCTYPE html>
<html>
<head>
	<title>Csm</title>
  <link rel="stylesheet" type="text/css" href="boostrap/css/boostrap.css">
</head>
<body>
<div class ="page-header"><h1 style="text-align:center;">Tables for cars</h1></div>
<table>
<table class="table table-bordered table-hover">
<thead>


<tr>
        <th>ID</th>
        <th>Carmodel</th>
        <th>Carmaker</th>
        <th>Registration</th>
        <th>Year</th>
        <th>transmission</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody>
<tr>
<?php 
 $getData = $pdo->prepare("SELECT  cars_info.car_id,registration_no, year,transmission, car_model.model_name, car_model.models_id, 
 car_make.maker_name,car_make.maker_id FROM cars_info 
 LEFT JOIN car_make ON car_make.maker_id = cars_info.car_maker_id
 LEFT JOIN car_model ON car_model.models_id = cars_info.car_model_id");
 $getData->execute();

	while($rows = $getData->fetch(PDO::FETCH_ASSOC)){
    $themodel_id= $rows['models_id'];
    $the_maker_name= $rows['maker_name'];
    $the_model_name= $rows['model_name'];
    $the_registration= $rows['registration_no'];
    $the_year= $rows['year'];
    $the_transmission= $rows['transmission'];
    $car_id= $rows['car_id'];
    
    ?>


<td> <?php echo $themodel_id; ?></td>
<td> <?php echo $the_model_name; ?></td>
<td> <?php echo $the_maker_name; ?></td>
<td> <?php echo $the_registration; ?></td>
<td> <?php echo $the_year; ?></td>
<td> <?php echo $the_transmission; ?></td>
<td><?php echo "<a href='edit-alt.php?car_id=$car_id'> Edit </a>"; ?></td>
<td><?php echo "<a href='viewcars.php?delete=$car_id'> Delete </a>"; ?></td>

</tr>

 <?php }

if(isset($_GET['delete'])){
  $the_del = $_GET['delete'];
  $stmt=$pdo->prepare("DELETE FROM cars_info WHERE car_id=:car_id");
  $stmt->bindParam(':car_id',$the_del,PDO::PARAM_INT);
  $stmt->execute();
  header('location:viewcars.php');


}
?>

  
</script>

</script>

</tbody>
</table>
</body>



<script type="text/javascript" src="boostrap/js/jquery.js"></script>
<script type="text/javascript" src="boostrap/js/popper.js"></script>
<script type="text/javascript" src="boostrap/js/boostrap.js"></script>
</body>
</html>