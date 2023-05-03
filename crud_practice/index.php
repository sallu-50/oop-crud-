<?php 
 
    //include_once 'classes/register.php';
    include 'classes/register.php';
    $reg = new Register();

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $register = $reg->addRegister($_POST, $_FILES);

     }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>crud practice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <?php
                        if (isset($register)) {
                            ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?php echo $register ;?></strong>
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php
                        }
                    
                    ?>
                 <div class="card-header">
                    <h1 class="text-center">Registration</h1>
                 </div>
                 <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="name">Name :</label>
                        <input type="text" name="name" placeholder="Enter Your Name " class="form-control">

                        <label for="email">Email :</label>
                        <input type="email" name="email" placeholder="Enter Your email " class="form-control">

                        <label for="">Phone :</label>
                        <input type="number" name="phone" placeholder="Enter Your phone number" class="form-control">

                        <label for="">Photo :</label>
                        <input type="file" name="photo"  class="form-control">

                        <label for="email">Address :</label>
                        <textarea name="address" id="" cols="2" rows="2" class="form-control"></textarea>

                        <input type="submit" value="Registration" name="submit" class="btn btn-success form-control my-2">
                    </form> 
                </div>
                </div>
                
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>