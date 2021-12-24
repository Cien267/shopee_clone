<?php
   session_start();
   header('Content-Type: text/html; charset=UTF-8');

   include_once "head.php"; 
   include_once "header.php"; 

   require "./libs/orders.php";

   $id = isset($_GET['id']) ? (int)$_GET['id'] : '';

   if($id){
        $order = get_order($id);
   }

   if(!$order){
        header("location: trangchu.php");
    }

   if(isset($_POST['edit'])){

        $shop_name   = isset($_POST['shop_name']) ? $_POST['shop_name'] : '';
        $product_name   = isset($_POST['product_name']) ? $_POST['product_name'] : '';
        $product_quantity      = isset($_POST['product_quantity']) ? $_POST['product_quantity'] : '';
        $cost   = isset($_POST['cost']) ? $_POST['cost'] : '';
        $status   = isset($_POST['status']) ? $_POST['status'] : '';

        $target_dir = "images/product/";
        
        $img_name = $_FILES['product_image']['name'];
        
        
        $time = time();
        $new_img_name = $time. "_".$img_name;
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_dir.$new_img_name);

        $result = edit_order($id, $shop_name, $product_name, !empty($_FILES['product_image']['name']) ? $new_img_name : $order['product_image'], $product_quantity, $cost, $status);
         if($result){
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
               <form class="form-horizontal" style="padding-top: 40px"
               action="order-edit.php?id=<?php echo $order['id'];?>" method="post" enctype="multipart/form-data">
                  <fieldset>

                  <!-- Form Name -->
                  <legend>SỬA ĐƠN HÀNG</legend>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="shop_name">Tên cửa hàng</label>  
                    <div class="col-md-4">
                    <input id="shop_name" name="shop_name" placeholder="tên cửa hàng" class="form-control input-md" required="" type="text" value="<?php echo !empty($order['shop_name']) ? $order['shop_name'] : ''; ?>">
                      
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="product_name">Tên sản phẩm</label>  
                    <div class="col-md-4">
                    <input id="product_name" name="product_name" placeholder="tên sản phẩm" class="form-control input-md" required="" type="text" value="<?php echo !empty($order['product_name']) ? $order['product_name'] : ''; ?>">
                      
                    </div>
                  </div>

                  <!-- File --> 
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="product_image">Ảnh sản phẩm</label>
                    <div class="col-md-4">
                      <input id="product_image" name="product_image" class="input-file" type="file" accept="image/png, image/gif, image/jpeg">
                    </div>
                  </div>

                  <!-- Num input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="product_quantity">Số lượng sản phẩm</label>  
                    <div class="col-md-4">
                    <input id="product_quantity" name="product_quantity" placeholder="số lượng sản phẩm" class="form-control input-md" required="" type="number" value="<?php echo !empty($order['product_quantity']) ? $order['product_quantity'] : ''; ?>">  
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="cost">Tổng số tiền</label>  
                    <div class="col-md-4">
                    <input id="cost" name="cost" placeholder="tổng số tiền" class="form-control input-md" required="" type="text" value="<?php echo !empty($order['cost']) ? $order['cost'] : ''; ?>">
                      
                    </div>
                  </div>

                  <!-- Select  -->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="status">Trạng thái đơn hàng</label>
                    <div class="col-md-4">
                      <select id="status" name="status" class="form-control">
                        <option value=""></option>
                        <option value="đã hủy" <?php if($order['status'] == "đã hủy") echo 'selected'; ?> >Đã hủy</option>
                        <option value="đã giao" <?php if($order['status'] == "đã giao") echo 'selected'; ?>>Đã giao</option>
                        <option value="đang giao"<?php if($order['status'] == "đang giao") echo 'selected'; ?>>Đang giao</option>
                        <option value="chờ lấy hàng"<?php if($order['status'] == "chờ lấy hàng") echo 'selected'; ?>>Chờ lấy hàng</option>
                        <option value="chờ xác nhận"<?php if($order['status'] == "chờ xác nhận") echo 'selected'; ?>>Chờ xác nhận</option>
                      </select>
                    </div>
                  </div>

                  
                  <div class="form-group" style="padding-top:50px">
                     <input class="btn btn-default" type="submit" name="edit" value="Sửa`" style="background: linear-gradient(to right, #1d87b9 0%, #61d0e0 100%); ">
                  </div>
                  
                  

                  </fieldset>
               </form>
            </div>
        </div>
   </div>
</body>
</html>