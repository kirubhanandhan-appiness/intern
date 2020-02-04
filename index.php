
<html>  
    <head>  
             <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 

            <title>Image Crop and Save into Database </title>  
            <!-- <script src="jquery.min.js"></script>  
            <script src="bootstrap.min.js"></script> -->
            <script src="croppie.js"></script>
            <!-- <link rel="stylesheet" href="bootstrap.min.css" /> -->
            <link rel="stylesheet" href="croppie.css" />
    </head>  
    </head>  
    <body>  
        <div class="container">
          <br />
      <h3 align="center">Image Crop and Save into Database</h3>
      <br />
      <br />
   <div class="panel panel-default">
      <div class="panel-body" align="center">
       <input type="file" name="insert_image" id="insert_image" accept="image/*" />
       <br />
       <div id="store_image"></div>
      </div>
     </div>
    </div>


    </body>  
</html>

    <div id="insertimageModal" class="modal" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Crop & Insert Image</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8 text-center">
            <div id="image_demo" style="width:250px; margin-top:20px"></div>
          </div>
          <div class="col-md-4" style="padding-top:30px;">
        <br />
        <br />
        <br/>
            <button class="btn btn-success crop_image">Crop & Insert Image</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<script>  
$(document).ready(function(){

 $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:100,
      height:100,
      type:'square' 
    },
    boundary:{
      width:200,
      height:200
    }    
  });

  $('#insert_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#insertimageModal').modal('show'); 
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:'insert.php',
        type:'POST',
        data:{"image":response},
        success:function(data){
          $('#insertimageModal').modal('hide');
          load_images();
          alert(data);
        }
      })
    });
  });

  load_images();

  function load_images()
  {
    $.ajax({
      url:"fetch_images.php",
      type:"post",
      success:function(data)
      {
        $('#store_image').html(data);
      }
    })
  }

});  
</script>