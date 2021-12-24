<?php
   session_start();
   header('Content-Type: text/html; charset=UTF-8');

   include_once "head.php"; 
   include_once "header.php"; 

  $username = $_SESSION['username'];
  include('ketnoi.php');
  $sql = "SELECT * FROM user WHERE username='$username' ";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) != 0){
      $user = mysqli_fetch_array($result);
  }

  $id = isset($_GET['id']) ? (int)$_GET['id'] : '';

   if(isset($_POST['edit'])){

        $email   = isset($_POST['email']) ? $_POST['email'] : '';
        $phone_number      = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
        $address   = isset($_POST['address']) ? $_POST['address'] : '';

        $target_dir = "images/user/";
        
        $img_name = $_FILES['avatar']['name'];
        
        
        $time = time();
        $new_img_name = $time. "_".$img_name;
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_dir.$new_img_name);

        $avatar = !empty($_FILES['avatar']['name']) ? $new_img_name : $user['avatar'];
        $sql3 = "UPDATE user SET username = '$username', email = '$email', phone_number = '$phone_number', address = '$address', avatar = '$avatar'  WHERE id = $id";
         $result3 = mysqli_query($conn, $sql3);
        
         if($result3){
             echo ("<SCRIPT LANGUAGE='JavaScript'>
             window.alert('Sửa thành công!')
             window.location.href='trangchu.php';
             </SCRIPT>");

         }else {
             echo '<script type="text/javascript">alert("Có lỗi xảy ra!")</script>';
         }
     
        
    } 
   
?>

<body>
   <div class="container-fluid text-center">
        <div class="row content">
            <?php
               include_once "sidebar.php"; 
            ?>
            <div class="col-sm-9">
               <div class="row text-left">
                   <h3>Sửa thông tin cá nhân</h3>
               </div>
               <div style="border-bottom: 1px solid gray;"></div>
               <div>
                  <form class="form-horizontal" style="padding-top: 40px"
               action="profile.php?id=<?php echo $user['id'];?>" method="post" enctype="multipart/form-data">
                  <div class="col-sm-3">
                     <div class="text-center">
                      <img src="./images/user/<?php echo $user['avatar'] ?>" class="avatar img-circle" alt="avatar">
                      <h6>Cập nhật ảnh đại diện...</h6>
                      
                      <input id="avatar" name="avatar" class="input-file" type="file" accept="image/png, image/gif, image/jpeg">
                    </div>
                  </div>
                  <div class="col-sm-8">
                     <fieldset>
                     

                     <!-- Text input-->
                     <div class="form-group">
                       <label class="col-md-4 control-label" for="email">Email</label>  
                       <div class="col-md-4">
                       <input id="email" name="email" placeholder="Email" class="form-control input-md" required="" type="email" value="<?php echo !empty($user['email']) ? $user['email'] : ''; ?>">
                         
                       </div>
                     </div>

                     <!-- Text input-->
                     <div class="form-group">
                       <label class="col-md-4 control-label" for="phone_number">Số điện thoại</label>  
                       <div class="col-md-4">
                       <input id="phone_number" name="phone_number" placeholder="Số điện thoại" class="form-control input-md" required="" type="text" value="<?php echo !empty($user['phone_number']) ? $user['phone_number'] : ''; ?>">
                         
                       </div>
                     </div>

                     <!-- Text input-->
                     <div class="form-group">
                       <label class="col-md-4 control-label" for="address">Địa chỉ</label>  
                       <div class="col-md-4">
                       <input id="address" name="address" placeholder="Địa chỉ" class="form-control input-md" required="" type="text" value="<?php echo !empty($user['address']) ? $user['address'] : ''; ?>">
                         
                       </div>
                     </div>

                     
                     <div class="form-group" style="padding-top:50px">
                        <input class="btn btn-default" type="submit" name="edit" value="Cập Nhật" style="background: linear-gradient(to right, #1d87b9 0%, #61d0e0 100%); ">
                     </div>
                  
                  

                  </fieldset>
                  </div>
               </form>
               </div>
                  
            </div>
        </div>
   </div>
</body>
</html>