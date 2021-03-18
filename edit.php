<?php
require_once('db.php');

if(isset($_GET['car_id'])){
  $thecar_id = $_GET['car_id'];
}

$getcar=$pdo->prepare("SELECT year,registration_no,transmission,
car_make.maker_name, car_make.maker_id, cars_info.car_id FROM cars_info
LEFT JOIN car_make ON car_make.maker_id = cars_info.car_maker_id
GROUP BY car_make.maker_name");
$getcar->execute();
while($row=$getcar->fetch(PDO::FETCH_ASSOC)){
  $thecar_id =$row['car_id'];
  $theyear = $_row['year'];
  $the_registration = $row['registration_no'];
  $the_maker = $row['maker'];
  $the_model = $row['model'];
  $transmission =$row['transmission'];
  $thedate=date('d-m-y');
  
}
if(isset($_POST['update'])){
  $thecar_id =$POST['car_id'];
  $theyear = $_POST['year'];
  $the_registration = $_POST['registration_no'];
  $the_maker = $_POST['maker'];
  $the_model = $_POST['model'];
  $transmission =$_POST['transmission'];
  $thedate=date('d-m-y');
}


$makers = [];
while ($car = $getData->fetch(PDO::FETCH_ASSOC)) {
  $data[] = $car;
}

?>
<!DOCTYPE html>
<html>
<head>
   	<title>Csm</title>
  <link rel="stylesheet" type="text/css" href="boostrap/css/boostrap.css">
  
</head>
<body>
<!-- <script type="text/javascript" src="boostrap/js/jquery.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container" >
 <form method="post" action="">
    <div class="form-group">
    <div class="page-header"><h1>Update Cars</div>
    <label for="Year">Year</labe>
    <input type="text" class="form-control" name="year" placeholder="year">
    </div>
      <div class="form-group">
      <label for="">registration_no</labe>
      <input type="text" class="form-control" name="registration_no" placeholder="model">
      </div>

    <select name="maker" id="maker" class="form-control">
    <option >Select Maker </option>
      <?php 
      foreach($data as $datas) {
        //var_dump($datas['maker_name']);
        ?>
      <option 
        value="<?php echo $datas['maker_id'] ?>" 
        data-cars="<?php echo json_encode($datas)  ?>">
        <?php echo $datas['maker_name']  ?>
      </option>
      <?php } ?>
    </select>

    <select name="model" id="model" class="form-control">
    <option value="">Select model</option>
    </select>
    <div class="form-group">
    <label for="transmision">transmission</labe>
    <input type="text" class="form-control" name="transmission" placeholder="transmission">
    </div>
    <button type="submit"class="btn btn-primary" name="update">UPDATE</button>
 </form>
</div>

<script>

  $('#maker').on('change', function() {
    var maker_id = $(this).val();
    console.log($.get);
    $.ajax({
      url: "http://localhost/csm/models.php?maker_id="+maker_id
    }).done(function(data) {
      var cars = JSON.parse(data);
    var options = '<option value="">Select model</option>';
    for (let i = 0; i < cars.length; i++) {
      options += '<option value="'+cars[i]['models_id']+'">'+cars[i]['model_name']+'</option>'
      console.log( '<option value="'+cars[i]['models_id']+'">'+cars[i]['model_name']+'</option>')
    }

    $('#model').html(options)
    });
  
  })
</script>