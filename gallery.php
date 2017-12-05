<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <form enctype="multipart/form" id="myphotoform">
                <div class="form-group">
                <lable for="caption">CAPTION</lable>
                <input type="text" class="form-control" name="caption" />
                </div>
                <div class="form-group">
                <lable for="photo">PHOTO</lable>
                <input type="file" class="form-control" name="photo" />
                </div>
            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </form>
            <div id="result">
                
            </div>
           
             </div>
        <div class="container">
             <?php
        $hostname="localhost";
        $username="root";
        $password="";
        $databasename="gallery";
        
        $conn=new mysqli ($hostname,$username,$password,$databasename);
        $q="select * from gallerytable";
        $result=$conn->query($q);
        
        while ($row = mysqli_fetch_assoc($result)){
     ?>      
   
    
            <div id="mygalphoto" style="float: left;">
            <img src="<?php echo $row ['photo'];  ?>" height="100" width="100" alt="NA" style="height: 100px;width:80px;border:2px solid black;margin-left: 15px;"/>
            <div><?php echo $row ['caption'];  ?></div> 
            </div>
    
    
<?php
}
        ?>

        </div>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        
          <script type="text/javascript">
            /* Attach a submit handler to the form */
$("#myphotoform").submit(function(event)
{
     var ajaxRequest;
    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
    $("#result").html('');

    /* Get from elements values */
  //  var values = $(this).serialize();
 var formData = new FormData(this);
    /* Send the data using post and put the results in a div */
    /* I am not aborting previous request because It's an asynchronous request, meaning 
       Once it's sent it's out there. but in case you want to abort it  you can do it by  
       abort(). jQuery Ajax methods return an XMLHttpRequest object, so you can just use abort(). */
       ajaxRequest= $.ajax({
            url: "gallery_action.php",
            type: "post",
            
            data: formData,
             cache: false,
        contentType: false,
        processData: false
        });

      /*  request cab be abort by ajaxRequest.abort() */

     ajaxRequest.done(function (response, textStatus, jqXHR){
          // show successfully for submit message
          //$("#result").html('Submitted successfully');
          $("#result").html(response);
     });

     /* On failure of request this function will be called  */
     ajaxRequest.fail(function (){
       // show error
       $("#result").html('There is error while submit');
     });
 });
            </script>
    </body>
</html>
