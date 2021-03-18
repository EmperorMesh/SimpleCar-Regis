<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">       
   	<title>Csm</title>
  <link rel="stylesheet" type="text/css" href="boostrap/css/boostrap.css">
  <script>
  $(document).ready(function(){
  $("button").click(function(){
  var  img =$(".fa fa-users").val();
  var chat = $("#chat_box").val();
  var user = $("#username").val();
  var icon = "<span class='fa fa-users'></span>";
  $("#message").append('br>',icon, user, '<br>', chat);
  //$("#message").before(user,img,chat);
  });
  });
  </script>
</head>
<body>
<div class="container">
<div class="box" style="width: 400px; height:600px; border:1px solid; margin-top:10px; border-radius:1em;color:blue;">
<div id="message">
</div>
  </div>
<div class="row">
<div class="col-md-4">
 <form>
 <label for="username">Username</label>
 <div class="form-group">
 <input type="text" name="username" id="username" class="form-control" placeholder="    Enter username">
 <i  style="position:relative; bottom:30px; left:300px; "class="fa fa-users fa-md"></i>
 </div>
 <textarea class="form-control" rows="3"  id="chat_box" placeholder="Type your messages here" ></textarea>
 <button class="btn btn-primary" type="button"  style="position:relative; left:280px; margin-top:4px;">ENTER</button>
 </form>
</div>
  </div>
</div>
</body>  
<script type="text/javascript" src="boostrap/js/popper.js"></script>
<script type="text/javascript" src="boostrap/js/boostrap.js"></script>
</body>
</html>