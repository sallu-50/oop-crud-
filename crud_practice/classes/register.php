<?php

 include 'lib/database.php';

class Register{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
        
    }
    public function addRegister($_post, $_file) {
        $name = $_post['name'];
        $email = $_post['email'];
        $phone = $_post['phone'];
        $address = $_post['address'];
    
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_file['photo']['name'];
        $file_size = $_file['photo']['size'];
        $file_tmp = $_file['photo']['tmp_name']; 
    
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_img = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $upload_img = "upload/" . $unique_img;
    
        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($file_name)) {
            $msg = "Fields must not be empty";
            return $msg;
        } elseif ($file_size > 2000000) {
            $msg = "Image size is too large";
            return $msg;
        } elseif (!in_array($file_ext, $permited)) {
            $msg = "You can upload only " . implode(', ', $permited);
            return $msg;
        } else {
            move_uploaded_file($file_tmp, $upload_img);
    
            $stmt = $this->db->link->prepare("INSERT INTO register (name, email, phone, image, address) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $email, $phone, $upload_img, $address);
            $result = $stmt->execute();
            $stmt->close();
    
            if ($result) {
                // Set a session variable to hold the success message
                $_SESSION["success_msg"] = "Registration successful";
                // Display a confirmation message to the user
                echo "<script>alert('Registration successful!')</script>";
                // Redirect the user to the home page
                header("Location: home.php");
                exit;
            } else {
                $msg = "Registration failed";
                return $msg;
            }
        }
    }

    public function allStudent(){
        $query ="SELECT * FROM register ORDER BY id DESC ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getStdByid($id){
        $query ="SELECT * FROM register where id = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    
    //update data start 
    public function UpdateData($_post, $_file,$id){
        $name = $_post['name'];
        $email = $_post['email'];
        $phone = $_post['phone'];
        $address = $_post['address'];
    
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_file['photo']['name'];
        $file_size = $_file['photo']['size'];
        $file_tmp = $_file['photo']['tmp_name']; 
    
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_img = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $upload_img = "upload/" . $unique_img;
    
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $msg = "Fields must not be empty";
            return $msg;
//for update 
        }if(!empty($file_name)){

            if ($file_size > 2000000) {
                $msg = "Image size is too large";
                return $msg;
            } elseif (!in_array($file_ext, $permited)) {
                $msg = "You can upload only " . implode(', ', $permited);
                return $msg;
            } else {
//old image replece code start
                $img_query = "SELECT * FROM register WHERE id = '$id'";
                $img_res = $this->db->select($img_query);
                if ($img_res) {
                    while($row= mysqli_fetch_assoc($img_res)){
                        $img = $row['image'];
                        unlink($img);
                    }
                }                                   //old image replece code end


                move_uploaded_file($file_tmp, $upload_img);
                $query="UPDATE register SET name = '$name', email='$email', phone='$phone', image='$upload_img', address='$address' WHERE id = '$id'";
                $result = $this->db->update($query);
        
                if ($result) {
                    $msg = "update successful";
                    // Set a session variable to hold the success message
                    $_SESSION["success_msg"] = $msg;
                    // Redirect the user to the home page
                    header("Location: home.php");
                   //return $msg;

                    exit;
                } else {
                    $msg = "update failed";
                    return $msg;
                }
            }
        }else {
                $query="UPDATE register SET name = '$name', email='$email', phone='$phone', address='$address' WHERE id = '$id'";
                $result = $this->db->update($query);
        
                if ($result) {
                    $msg = "update successful";
                    // Set a session variable to hold the success message
                         $_SESSION["success_msg"] = $msg;
                    // Redirect the user to the home page
                        header("Location: home.php");
                     exit;
                   
                } else {
                    $msg = "update failed";
                    return $msg;
                }
            }


        }//update data end 

        //delete method 
       public function deleteData($id){
        
        //old image replece code start
        $img_query = "SELECT * FROM register WHERE id = '$id'";
        $img_res = $this->db->select($img_query);
        if ($img_res) {
            while($row= mysqli_fetch_assoc($img_res)){
                $img = $row['image'];
                unlink($img);
            }
        }                            //old image replece code end

        $del_query= "DELETE FROM register WHERE id = '$id'";
        $del = $this->db->delete($del_query);
        if ($del) {
            $msg = "update successful";
            // Set a session variable to hold the success message
            $_SESSION["success_msg"] = $msg;
            // Redirect the user to the home page
             header("Location: home.php");
             exit;
        } else {
            $msg = "update failed";
            return $msg;
        }

        
       }


        
    }






?>