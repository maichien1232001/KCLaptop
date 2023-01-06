<center><!--  center Begin  -->
    
<h1> Đơn đặt hàng </h1>
    
    <p class="text-muted">
        
    Nếu bạn có bất kỳ câu hỏi nào, vui lòng <a href="../contact.php">Liên hệ</a>. Dịch vụ khách hàng của chúng tôi <strong>24/7</strong>
        
    </p>
    
</center><!--  center Finish  -->


<hr>


<div class="table-responsive"><!--  table-responsive Begin  -->
    
    <table class="table table-bordered table-hover"><!--  table table-bordered table-hover Begin  -->
        
        <thead><!--  thead Begin  -->
            
            <tr><!--  tr Begin  -->
                
                <th> Số hóa đơn: </th>
                <th> Số tiền phải trả: </th>
                <th> Số hóa đơn: </th>
                <th> Số lượng: </th>
                <th> Loại: </th>
                <th> Ngày đặt hàng:</th>
                <th> Đã thanh toán / Chưa thanh toán: </th>
                <th> Trạng thái: </th>
                
            </tr><!--  tr Finish  -->
            
        </thead><!--  thead Finish  -->
        
        <tbody><!--  tbody Begin  -->
           
           <?php 
            
            $customer_session = $_SESSION['customer_email'];
            
            $get_customer = "select * from customers where customer_email='$customer_session'";
            
            $run_customer = mysqli_query($con,$get_customer);
            
            $row_customer = mysqli_fetch_array($run_customer);
            
            $customer_id = $row_customer['customer_id'];
            
            $get_orders = "select * from customer_orders where customer_id='$customer_id'";
            
            $run_orders = mysqli_query($con,$get_orders);
            
            $i = 0;
            
            while($row_orders = mysqli_fetch_array($run_orders)){
                
                $order_id = $row_orders['order_id'];

                $p_id = $row_orders['p_id'];
                
                $due_amount = $row_orders['due_amount'];
                
                $invoice_no = $row_orders['invoice_no'];
                
                $qty = $row_orders['qty'];
                
                $type = $row_orders['type'];
                
                $order_date = substr($row_orders['order_date'],0,11);
                
                $order_status = $row_orders['order_status'];
                
                $i++;
                
                if($order_status=='pending'){

                    $get_p_orders = "select * from customer_orders where customer_id='$customer_id' and order_status = 'pending'";
            
                    $run_p_orders = mysqli_query($con,$get_p_orders);
                    
                    while($row_porders = mysqli_fetch_array($run_p_orders)){

                        $p_id = $row_porders['p_id'];
                        
                        $qty = $row_porders['qty'];

                        $order_status = $row_porders['order_status'];
                        
                        $update_qty = "update products set product_qty = product_qty - $qty  where product_id='$p_id'";
                        
                        $run_update_qty = mysqli_query($con,$update_qty);
                    }
                    
                    $order_status = 'Chưa thanh toán';
                    
                }else{
                    
                    $order_status = 'Đã thanh toán';
                }
            
            ?>
            
            <tr><!--  tr Begin  -->
                
                <th> <?php echo $i; ?> </th>
                <td> $<?php echo $due_amount; ?> </td>
                <td> <?php echo $invoice_no; ?> </td>
                <td> <?php echo $qty; ?> </td>
                <td> <?php echo $type; ?> </td>
                <td> <?php echo $order_date; ?> </td>
                <td> <?php echo $order_status; ?> </td>
                
                <td>
                    
                    <a href="confirm.php?order_id=<?php echo $order_id; ?>" target="_blank" class="btn btn-primary btn-sm"> Xác nhận đã thanh toán </a>
                    
                </td>
                
            </tr><!--  tr Finish  -->
            
            <?php } ?>
            
        </tbody><!--  tbody Finish  -->
        
    </table><!--  table table-bordered table-hover Finish  -->
    
</div><!--  table-responsive Finish  -->