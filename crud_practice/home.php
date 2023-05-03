<?php 
 
    //include_once 'classes/register.php';
    include 'classes/register.php';
    $reg = new Register();

    if(isset($_GET['deldata'])){
        $deleteid= base64_decode($_GET['deldata']);
        $delete = $reg->deleteData($deleteid);
    }


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>crud practice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  </head>
  <body>
    
    <div class="container mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="container ">
                <div class="card shadow">

               
                
                 <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div><h3 class="text-left">All data display </h3></div>
                        <div>
                            <a href="index.php"><button class="btn btn-success">Add data </button></a>
                        </div>
                    </div>
                 </div>
                 <div class="card-body">
                    <table class="table able-success table-striped table-bordered">
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Photo</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>

                        <?php 
                             $allstd = $reg->allStudent();
                                if ($allstd) {
                                    while ($row = mysqli_fetch_assoc($allstd)) {
                                        ?>

                                            <tr class="center">
                                                <td><?php echo $row ['name'];?></td>
                                                <td><?php echo $row ['email'];?></td>
                                                <td><?php echo $row ['phone'];?></td>
                                                <td><img src="<?php echo $row ['image'] ;?>" style='width: 100px; height: 100px;' class="img-fluid" alt=""></td>
                                                <td><?php echo $row ['address'] ;?></td>

                                                <td>
                                                    <a href="edit.php?id= <?php  echo base64_encode( $row['id']);?>"><i class='fas fa-edit' style='font-size:27px;color:green'></i></a>
                                                    <a href="?deldata=<?php echo base64_encode($row ['id']);?>" onclick="return confirm ('are you want to delete ?')"><i class='fas fa-trash-alt' style='font-size:27px;color:red'></i></a>
                                                </td>
                                                
                                               
                                                
                                            </tr>

                                        <?php
                                    }
                                }

                        ?>

                       
                    </table>
                </div>
                </div>
                
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>