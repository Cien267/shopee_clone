<?php
   session_start();
   header('Content-Type: text/html; charset=UTF-8');

   include_once "head.php"; 
   include_once "header.php"; 

   if(isset($_POST['contact'])){
        include('ketnoi.php');

        $name   = isset($_POST['name']) ? $_POST['name'] : '';
        $email  = isset($_POST['email']) ? $_POST['email'] : '';
        $msg    = isset($_POST['msg']) ? $_POST['msg'] : '';

        $sql = "INSERT INTO contact (name, email, msg) VALUES ('$name', '$email', '$msg')";
        $result = mysqli_query($conn, $sql);

        
         if($result){
             echo ("<SCRIPT LANGUAGE='JavaScript'>
             window.alert('Gửi thành công!')
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
               <div class="wrapper" style="margin: 50px auto;
    padding: 10px;">
                <section class="form login">
                    <header>Gửi phản hồi</header>
                    <form action="contact.php" method="post">
                        <div class="error-tx">
                            
                        </div>
                        <div class="field input">
                                <label for="">Tên:</label>
                                <input type="text" name="name" placeholder="tên" required> 
                        </div>
                        <div class="field input">
                                <label for="">Email:</label>
                                <input type="text" name="email" placeholder="email" required> 
                        </div>
                        <div class="field input">
                                <label for="">Tin nhắn:</label>
                                <textarea name="msg" id="" cols="30" rows="10" required></textarea>
                                
                        </div>
                        
                        <div class="field button">
                                <input type="submit" name="contact" value="Gửi">
                        </div>
                        
                    </form>
                    
                </section>
            </div>
            </div>
        </div>
   </div>
</body>
</html>