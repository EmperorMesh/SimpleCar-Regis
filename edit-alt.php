<?php include "db.php"; ?>
<!DOCTYPE html>
<html>

<head>
  <title>Csm</title>
  <link rel="stylesheet" type="text/css" href="boostrap/css/boostrap.css">

</head>

<body>

  <?php

  require_once('db.php');


  if (isset($_GET['car_id'])) {
    $id = $_GET['car_id'];
    $query = "SELECT * FROM cars_info WHERE car_id=:id";
    $request = $pdo->prepare($query);
    $request->bindParam(':id', $id);
    $request->execute();
    $car = $request->fetch(PDO::FETCH_ASSOC);
    if (!$car) {
      // return 404;
    }
  } else {
    // return 404 
  }

  if (isset($_POST['update'])) {
    $theyear = $_POST['year'];
    $the_registration = $_POST['registration_no'];
    $the_maker = $_POST['car_maker_id'];
    $the_model = $_POST['car_model_id'];
    $transmission = $_POST['transmission'];
    $thedate = date('d-m-y');

    $stmt = (" UPDATE cars_info SET 
   year=:year,
   date=:date,
   registration_no =:registration_no,
   car_maker_id=:car_maker_id,
   car_model_id=:car_model_id,
  transmission=:transmission 
   WHERE car_id =:id");
    //  var_dump($query);
    $update = $pdo->prepare($stmt);
    $update->bindValue(':id', $id);
    $update->bindValue(':date', $thedate);
    $update->bindValue(':year', $theyear);
    $update->bindValue(':registration_no', $the_registration);
    $update->bindValue(':car_maker_id', $the_maker);
    $update->bindValue(':car_model_id', $the_model);
    $update->bindValue(':transmission', $transmission);
    $update->execute();
  }
  $getData = $pdo->prepare("SELECT year,registration_no,transmission,
car_make.maker_name, car_make.maker_id FROM cars_info
LEFT JOIN car_make ON car_make.maker_id = cars_info.car_maker_id
GROUP BY car_make.maker_name");
  $getData->execute();
  $makers = $getData->fetchAll(PDO::FETCH_ASSOC);

  $getData = $pdo->prepare("SELECT * FROM car_model where car_maker_id = :id");
  $getData->bindParam(':id', $car['car_maker_id']);
  $getData->execute();
  $models = $getData->fetchAll(PDO::FETCH_ASSOC);
  // var_dump($models)


  ?>


  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <form method="post" action="">
          <h1>Edit CarRegistration</h1>
          <div class="form-group">
            <label for="">registration_no</label>
            <input type="text" value="<?php echo $car['registration_no']; ?>" class="form-control" name="registration_no" placeholder="model">
          </div>
          <div class="form-group">
            <label for="Car Maker">Car Makers</label>
            <select name="car_maker_id" id="maker" class="form-control">
              <option>Select Maker </option>
              <?php
              foreach ($makers as $car_maker_id) {
                //var_dump($datas['maker_name']);
              ?>
                <option value="<?php echo $car_maker_id['maker_id'] ?>" <?php echo $car_maker_id['maker_id'] == $car['car_maker_id'] ? "selected" : ""; ?> data-cars="<?php echo json_encode($maker)  ?>">
                  <?php echo $car_maker_id['maker_name']  ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="">Car Models</label>
            <select name="car_model_id" id="model" class="form-control">
              <option value="">Select model</option>
              <?php
              foreach ($models as $car_model_id) {
                //var_dump($datas['model_name']);
              ?>
                <option value="<?php echo $car_model_id['models_id'] ?>" <?php echo $car_model_id['models_id'] == $car['car_model_id'] ? "selected" : ""; ?> data-cars="<?php echo json_encode($model)  ?>">
                  <?php echo $car_model_id['model_name']  ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <label for="Year">Transmission</label>
          <div class="form-group">
            <select name="transmission" id=transmission class="form-control">
              <option value=?><?php echo $car['transmission']; ?></option>
              <option>Automatic</option>
              <option>Manual</option>
            </select>

            <div class="form-group">
              <label for="Year">Car Year</label>
              <select name="year" id="year" class="form-control">
                <option value="#"><?php echo $car['year']; ?></option>
                <?php
                for ($year = 1960; $year <= 2021; $year++) {
                ?>

                  <option><?php echo $year; ?></option>
                <?php } ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary" name="update">submit</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $('#maker').on('change', function() {
      var maker_id = $(this).val();
      console.log($.get);
      $.ajax({
        url: "http://localhost/csm/models.php?maker_id=" + maker_id
      }).done(function(data) {
        var cars = JSON.parse(data);
        var options = '<option value="">Select model</option>';
        for (let i = 0; i < cars.length; i++) {
          options += '<option value="' + cars[i]['models_id'] + '">' + cars[i]['model_name'] + '</option>'
          console.log('<option value="' + cars[i]['models_id'] + '">' + cars[i]['model_name'] + '</option>')
        }

        $('#model').html(options)
      });

    })
  </script>

  <script type="text/javascript" src="boostrap/js/popper.js"></script>
  <script type="text/javascript" src="boostrap/js/boostrap.js"></script>
</body>

</html>