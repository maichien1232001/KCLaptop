<?php 
    
    $active='Contact';
    include("includes/header.php");

?>
  
   <div id="content"><!-- #content Begin -->
       <div class="container"><!-- container Begin -->
           <div class="col-md-12"><!-- col-md-12 Begin -->
               
               <ul class="breadcrumb"><!-- breadcrumb Begin -->
                   <li>
                       <a href="index.php">Trang chủ</a>
                   </li>
                   <li>
                       Liên hệ
                   </li>
               </ul><!-- breadcrumb Finish -->
               
           </div><!-- col-md-12 Finish -->
           
           <div class="account_center" style="margin-top: 5%; width: 60%; margin-left: 20%;"><!-- col-md-12 Begin -->
               
               <div class="box"><!-- box Begin -->
                   
               <div class="box-header"><!-- box-header Begin -->
                       
                       <center><!-- center Begin -->
                           
                           <h2> Cứ liên lạc nếu cần</h2>
                           
                           <p class="text-muted"><!-- text-muted Begin -->
                               
                           Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi. Dịch vụ khách hàng của chúng tôi <strong>24/7</strong>
                               
                           </p><!-- text-muted Finish -->
                           
                       </center><!-- center Finish -->
                       
                       <form action="contact.php" method="post"><!-- form Begin -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Tên</label>
                               
                               <input type="text" class="form-control" name="name" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Email</label>
                               
                               <input type="text" class="form-control" name="email" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Subject</label>
                               
                               <input type="text" class="form-control" name="subject" required>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="form-group"><!-- form-group Begin -->
                               
                               <label>Thông báo</label>
                               
                               <textarea name="message" class="form-control"></textarea>
                               
                           </div><!-- form-group Finish -->
                           
                           <div class="text-center"><!-- text-center Begin -->
                               
                               <button type="submit" name="submit" class="btn btn-primary">
                               
                               <i class="fa fa-user-md"></i> Gửi tin nhắn
                               
                               </button>
                               
                           </div><!-- text-center Finish -->
                           
                       </form><!-- form Finish -->
                       
                       <?php 
                       
                       if(isset($_POST['submit'])){
                           
                           /// Admin receives message with this ///
                           
                           $sender_name = $_POST['name'];
                           
                           $sender_email = $_POST['email'];
                           
                           $sender_subject = $_POST['subject'];
                           
                           $sender_message = $_POST['message'];
                           
                           $receiver_email = "mugianto4th@gmail.com";
                           
                           mail($receiver_email,$sender_name,$sender_subject,$sender_message,$sender_email);
                           
                           /// Auto reply to sender with this ///
                           
                           $email = $_POST['email'];
                           
                           $subject = "Chào mừng đến trang web của tôi";
                           
                           $msg = "Cảm ơn đã gửi tin nhắn cho chúng tôi. Chúng tôi sẽ trả lời tin nhắn của bạn sớm nhất có thể";
                           
                           $from = "mugianto4th@gmail.com";
                           
                           mail($email,$subject,$msg,$from);
                           
                           echo "<h2 align='center'> Tin nhắn của bạn đã được gửi thành công </h2>";
                           
                       }
                       
                       ?>
                       
                   </div><!-- box-header Finish -->
                   
               </div><!-- box Finish -->
               
           </div><!-- col-md-12 Finish -->
           
       </div><!-- container Finish -->
   </div><!-- #content Finish -->
   
   <?php 
    
    include("includes/footer.php");
    
    ?>
    
    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
</body>
</html>