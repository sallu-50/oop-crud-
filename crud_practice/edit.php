<?php 
 
    include 'classes/register.php';
    $reg = new Register();

    //for update get id 
    if (isset($_GET['id'])) {
        $id = base64_decode(($_GET['id']));
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $register = $reg->UpdateData($_POST, $_FILES,$id);
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
                    <h1 class="text-center">Update Data</h1>
                 </div>
                 <div class="card-body">
                        <?php 
                            $getstd = $reg->getStdByid($id);
                            if ($getstd) {
                                while ($row = mysqli_fetch_assoc($getstd)) {
                                    ?>
                                    
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <label for="name">Name :</label>
                                        <input type="text" name="name" value="<?php echo $row ['name'];?>" class="form-control">

                                        <label for="email">Email :</label>
                                        <input type="email" name="email" value="<?php echo $row ['email'];?>" class="form-control">

                                        <label for="">Phone :</label>
                                        <input type="number" name="phone" value="<?php echo $row ['phone'];?>"  class="form-control">

                                        <label for="">Photo :</label>
                                        <input type="file" name="photo"  class="form-control">
                                        <img src="<?php echo $row ['image'] ;?>" class="img-thumbnail" style='width: 100px; height: 100px;' alt=""><br>

                                        <label for="email">Address :</label>
                                        <textarea name="address" id="" cols="2" rows="2" class="form-control"><?php echo $row ['address'];?></textarea>

                                        <input type="submit" value="update" name="submit" class="btn btn-success form-control my-2">
                                    </form>
                                    
                                    
                                    <?php
                                }
                            }
                        
                        ?>

                     
                </div>
                </div>
                
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>