<?php
$msg = [];

if (isset($_POST['submit'])) {

  $theyear = $_POST['year'];
  $the_registration = $_POST['registration_no'];
  $the_maker = $_POST['maker'];
  $the_model = $_POST['model'];
  $transmission = $_POST['transmission'];
  $thedate = date('d-m-y');



  if ($theyear == "") {
    $msg['error'] = "<div class='alert alert-danger'> Year is required </div>";
  } else if ($the_registration == "") {
    $msg['error'] = "<div class='alert alert-danger'>Registration is requred </div>";
  } else if ($the_maker == "") {
    $msg['error'] = "<div class='alert alert-danger'>Maker is required </div>";
  } else if ($the_model == "") {
    $msg['error'] = "<div class='alert alert-danger'> Model is required </div>";
  } else if ($transmission == "") {
    $msg['error'] = "<div class='alert alert-danger'> transmission is required </div>";
  } else {
    $query = "INSERT INTO cars_info(year,date,registration_no,car_maker_id,car_model_id,transmission) 
   VALUE(:year,:date,:registration_no,:maker,:model,:transmission)";
    $insert = $pdo->prepare($query);
    $insert->bindParam(':date', $thedate);
    $insert->bindParam(':year', $theyear);
    $insert->bindParam(':registration_no', $the_registration);
    $insert->bindParam(':maker', $the_maker);
    $insert->bindParam(':model', $the_model);
    $insert->bindParam(':transmission', $transmission);
    $insert->execute();

    if ($insert->execute()) {
      $msg['error'] = "<div class='alert alert-sucess'> Record added successfully!";
    } else {
      $msg['error'] = "<div class='alert alert-danger'> Error adding record, check and try again!";
    }
  }
}
$getData = $pdo->prepare("SELECT year,registration_no,transmission,
car_make.maker_name, car_make.maker_id FROM cars_info
LEFT JOIN car_make ON car_make.maker_id = cars_info.car_maker_id
GROUP BY car_make.maker_name");
$getData->execute();

$makers = [];
while ($car = $getData->fetch(PDO::FETCH_ASSOC)) {
  $data[] = $car;
}

?>


<div class="container-fluid">

  <div class="row">
    <?php
    foreach ($msg as $msgs) {
      //  var_dump($msgs);
    } ?>
    <div class="container">
      <div class="col-md-5">
        <div style="padding: 10px, 0px, 15px, 5px;">
        </div>
        <form method="post" action="">
          <h1> Car Registration</h1>
          <div class="form-group">
            <label for="">Registration No</label>
            <input type="text" class="form-control" name="registration_no" id="registration_no" placeholder="Registration No">
          </div>
          <div class="form-group">
            <label for="Car Makers">Car Makers</label>
            <select name="maker" id="maker" class="form-control">
              <option value="">Select Maker </option>
              <?php
              foreach ($data as $datas) {
                //var_dump($datas['maker_name']);
              ?>
                <option value="<?php echo $datas['maker_id'] ?>" data-cars="<?php echo json_encode($datas)  ?>">
                  <?php echo $datas['maker_name']  ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="Car Model">Car Models </label>
            <select name="model" id="model" class="form-control">
              <option value="">Select model</option>
            </select>
          </div>

          <label for="Year">Transmission</label>
          <div class="form-group">
            <select name="transmission" id=transmission class="form-control">
              <option>---Transmission---</option>
              <option>Automatic</option>
              <option>Manual</option>
            </select>

            <div class="form-group">
              <label for="Year">Car Year</label>
              <select name="year" id=year class="form-control">
                <option>---Car Year---</option>
                <?php
                for ($year = 1960; $year <= 2021; $year++) {
                ?>
                  <option><?php echo $year; ?></option>
                <?php } ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">submit</button>
        </form>
      </div>
    </div>
  </div>

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