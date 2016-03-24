<!DOCTYPE>

<html>

<head>

<!-- meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<!-- favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
  
<!--Import Material Icons Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- link the materialize css file -->
  <link href="../css/materialize.css" rel="stylesheet" type="text/css" hreflang="en">

<!-- Link custom stylesheets -->
  <link href="./css/common_styles.css" rel="stylesheet" type="text/css" hreflang="en">

  <!-- Missing Stylesheet....ask dhruti for it -->
  <link rel="stylesheet" type="text/css" href="homepage_css.css">

</head>

<body>

  <?php
    require_once('../navbar_layout.php');
  ?>

      
  <div class="row">
    <div class="col l2"><br/></div>
    <div class="col l8">
      <div class="card">
        <div class="row card-content">
          <center><h5>Add Product</h5></center>
          <form class="col s12" action="../server/add_product.php" method="POST" >
            <div class="row">
              <div class="col l3"><br/></div>
              <div class="input-field col s12 l6">
                <input  id="product_id" type="text" class="validate">
                <label for="product_id">Product Id</label>
                <span id="product_id_error" style="display: hidden;">Field cannot be empty</span>
              </div>
              <div class="col l3"><br/></div>
            </div>
            <div class="row">
              <div class="col l3"><br/></div>
              <div class="input-field col s12 l6">
                <input id="product_name" type="text" class="validate">
                <label for="product_name">Product Name</label>
                <span id="product_name_error" style="display: hidden;">Field cannot be empty</span>
              </div>
              <div class="col l3"><br/></div>
            </div>
            <div class="row">
              <div class="col l3"><br/></div>
              <div class="input-field col s12 l6">
                <input id="vehicle_name" type="text" class="validate">
                <label for="vehicle_name">Vehicle Name</label>
                <span id="vehicle_name_error" style="display: hidden;">Field cannot be empty</span>
              </div>
              <div class="col l3"><br/></div>
            </div>
            <div class="row">
              <div class="col l3"><br/></div>
              <div class="input-field col s12 l6">
                <input id="product_description" type="text" class="validate">
                <label for="product_description">Product Description</label>
                <span id="product_description_error" style="display: hidden;">Field cannot be empty</span>
              </div>
              <div class="col l3"><br/></div>
            </div>
            <div class="row">
              <div class="col l3"><br/></div>
              <div class="input-field col s12 l6">
                <input id="rate" type="text" class="validate">
                <label for="rate">Rate</label>
                <span id="rate_error" style="display: hidden;">Field cannot be empty</span>
              </div>
              <div class="col l3"><br/></div>
            </div>
            <div class="row">
              <div class="col l3"><br/></div>
              <div class="input-field col s12 l6">
                <select>
                  <option value="" disabled selected>Choose your option</option>
                  <option value="1">Each</option>
                  <option value="2">Set</option>
                  <option value="3">Kit</option>
                </select>
                <label>Per</label>
              </div>
              <div class="col l3"><br/></div>
            </div>
            <div class="row">
              <div class="col l3"><br/></div>
              <div class="input-field col s12 l6">
                <input id="min_quantity" type="text" class="validate">
                <label for="min_quantity">Minimum Quantity</label>
                <span id="min_quantity_error" style="display: hidden;">Field cannot be empty</span>
              </div>
              <div class="col l3"><br/></div>
            </div>
            <div class="row">
              <div class="col l3"><br/></div>
              <div class="input-field col s12 l6">
                <div class="file-field input-field">
                  <div class="btn">
                    <span>File</span>
                    <input type="file" multiple>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload one or more files">
                  </div>
                </div>
              </div>
              <div class="col l3"><br/></div>
            </div>
            <div class="row">
              <center>
                <button class="btn waves-effect waves-light" type="submit" name="" onclick="validation();">Submit
                  <i class="material-icons right"></i>
                </button>
              </center>
            </div>
            <div class="col l4"><br/></div>
          </form>
        </div>
      </div>
    </div>
  </div>  
</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>

<script>

  $(document).ready(function() {
    $('body').css('color','red');
    $('select').material_select();
  });



function validation()
{
  alert(1);
  var pid=document.getElementById('product_id').value;
  
  if(pid == null || pid == '')
  {
    $('#product_id_error').show(100);
  }else{
    $('#product_id_error').hide(100);
  }

  var pname=document.getElementById('product_name').value;
  if(pname == null || pname == '')
  {
    $('#product_name_error').show(100);
  }else{
    $('#product_name_error').hide(100);
  }

  var vehicle=document.getElementById('vehicle_name').value;
  if(vehicle == null || vehicle == '')
  {
    $('#vehicle_name_error').show(100);
  }else{
    $('#vehicle_name_error').hide(100);
  }

  var description=document.getElementById('product_description').value;
  if(description == null || description == '')
  {
    $('#product_description_error').show(100);
  }else{
    $('#product_description_error').hide(100);
  }

  var rate=document.getElementById('rate').value;
  if(rate == null || rate == '')
  {
    $('#rate_error').html("Field cannot be empty.");
    $('#rate_error').show(100);
  }else if(!rate.match(/^\d+/))
  {
    $('#rate_error').html("Enetr only number");
    $('#rate_error').show(100);
  }
  else{
    $('#rate_error').hide(100);
  }


  var min=document.getElementById('min_quantity').value;
  if(min == null || min == '')
  {
    $('min_quantity_error').html("Field cannot be empty");
    $('#min_quantity_error').show(100);
  }else if(!min.match(/^\d+/))
  {
    $('#min_quantity_error').html("Enetr only number");
    $('#min_quantiy_error').show(100);
  }
  else{
    $('#min_quantity_error').hide(100);
  }
}

</script>


</body>

</html>
