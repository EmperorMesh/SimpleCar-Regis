<!DOCTYPE html>
<html>
<script>
</script>

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <title>Csm</title>
  <link rel="stylesheet" type="text/css" href="boostrap/css/boostrap.css">
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.js"></script>
<script>
  function validateEmail(value) {
    const emailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const isValid = emailRegex.test(value)
    return isValid
  }

  function validateName(value) {

    const nameRegex = /^[a-z ,.'-]+$/i;
    const isValid = nameRegex.test(value)
    return isValid
  }

  function validateLastname(value) {
    const nameRegex = /^[a-z ,.'-]+$/i;
    const islastNameValid = nameRegex.test(value)
    return islastNameValid
  }


  function validateAccountNumber(value) {
    if (value && value.length === 10 && !isNaN(value)) {
      return true
    } else return false

  }
  makeTextFile = function(text) {
    if (text) {
      console.log("called", text)
      var data = new Blob([text], {
        type: 'text/plain'
      });

      // If we are replacing a previously generated file we need to
      // manually revoke the object URL to avoid memory leaks.
      // if (textFile !== null) {
      //   window.URL.revokeObjectURL(textFile);
      // }
      const downloadButton = document.getElementById("downloadlink")


      textFile = window.URL.createObjectURL(data);
      downloadButton.href = textFile;
      downloadButton.click()
    }

  };

  function submit(event) {
    const email = document.querySelector("#email").value
    const isEmailValid = validateEmail(email)

    const name = document.querySelector("#name").value
    const isNameValid = validateName(name)

    const lastname = document.querySelector("#lastname").value
    const islastNameValid = validateLastname(lastname)


    const accountNumber = document.querySelector("#accountnumber").value
    const isaccountNumberValid = validateAccountNumber(accountNumber)


    if (!isNameValid) {
      alert("Invalid name");
      return alert(`${name} is not a valid name`)
    }
    if (!islastNameValid) {
      alert('invalid last name')
    }

    if (!isEmailValid) {
      alert("inva lid email");

      //return alert(`${email} is not a valid email`)
    }

    if (!isaccountNumberValid) {
      alert("invalid account number");
    }


    const click = document.getElementById('click');
    const firstname = document.getElementById('name');
    const bank = document.getElementById('banks');
    const accountname = document.getElementById('acctname');
    const accountnumber = document.getElementById('accountnumber');

    var data = {
      firstname: name,
      lastname,
      email,
      bank: bank.options[bank.selectedIndex].value,
      accountname: accountname.value,
      accountnumber: accountNumber

    }



    $.ajax({
      type: "post",
      url: 'insert.php',
      data: data,
      dataType: 'json',
      success: function(data) {
        if (makeTextFile()) {

          return true
        }
        //ceate file here
        if (isNameValid && isEmailValid && isaccountNumberValid) {
          console.log(data)
          makeTextFile(JSON.stringify(data))
        }
      },
      error: function(data) {
        if (!makeTextFile()) {
          return false;
        }
        //report error
      }
    })
    // event.target.type = "submit"
    // const registrationForm = document.getElementById("registration-form")
    // registrationForm.submit()


  }
  $(document).ready(function() {
    $("#hide").click(function(event) {
      event.preventDefault()


      $(".form").slideToggle();
    });

  });
</script>

<body>
  <div class="container">
    <div class="box" style="color:black; margin:auto; margin-top:2px; padding:5px;">
      <div class="row">
        <div class="col-lg-12">
          <form method="post" action="insert.php" id="registration-form">
            <h4 style=" margin-top:50px;display:block;"><i>Please Register Here</i></h4>
            <div class="form-group">
              <label for="name">First Name</label>
              <input type="text" class="form-control" placeholder="Please Enter First Name" id="name" name="firstname">
            </div>
            <div class="form-group">
              <label for="name">Last Name</label>
              <input type="text" class="form-control" placeholder="Please Enter Last Name" id="lastname" name="lastname">
            </div>
            <div class="form-group">
              <label for="name">Email</label>
              <input type="Email" class="form-control" placeholder="Please Enter Mail" id="email" name="email" multiple>
            </div>

            <a id="hide" class="btn btn-default">Bank Details</a>

            <div class="form">
              <div class="container-2 container">
                <h4 style="margin-top:2rem;"><i>Bank Details</i></h4>
                <div class="box" style="  color:black; margin:auto; margin-top:2px;">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class=form-group>
                        <select class="form-control" id="banks" name="bank">
                          <option>---Select Bank---</option>
                          <option value="='UBA Bank">UBA Bank</option>
                          <option value=">Zenith Bank">Zenith Bank</option>
                          <option>Access Bank</option>
                          <option>First Bank</option>
                          <option>Union Bank</option>
                          <option>Polaris Bank</option>
                          <option>GTB Bank</option>
                          <option>Wema Bank</option>
                          <option>Stanbic ibtc Bank</option>
                          <option>Heritage Bank</option>
                        </select>
                      </div>
                      <div class="form-group" <label for="name">Account Name</label>
                        <input type="text" class="form-control" placeholder="Please Enter account name" id="acctname" name="accountname" name="account">
                      </div>
                      <div class="form-group">
                        <label for="name">Account Number</label>
                        <input type="number" class="form-control" placeholder="Please Enter account number" id="accountnumber" name="accountnumber" name="phonenumber">
                      </div>
                      <button type="button" class="btn btn-success" id="click" name="submit">Submit</button>
                      <a class="btn btn-primary" href="" download="info.txt" id="downloadlink" style="display:none;">download</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript" src="boostrap/js/popper.js"></script>
  <script type="text/javascript" src="boostrap/js/boostrap.js"></script>

  <script>
    const buttonSubmit = document.getElementById("click")

    buttonSubmit.addEventListener("click", submit)
  </script>

</body>

</html>