<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li>
                
                <i class="fa fa-dashboard"></i> Bảng tin / Thống kê doanh thu
                
            </li>
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
                <h3 class="panel-title"><!-- panel-title begin -->
                
                    <i class="fa fa-tags fa-fw"></i> Xem thống kế
                
                </h3><!-- panel-title finish -->
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
            
            <?php 

            $con = new PDO('mysql:dbname=kychienlaptop;host=localhost', "root", "");

            ?>

            <!doctype html>
            <html lang="en">
              <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title></title>
                <style>
                  * {
                    margin: 0;
                    padding: 0;
                    font-family: sans-serif;
                  }
                  .chartMenu p {
                    padding: 10px;
                    font-size: 20px;
                  }
                  .chartCard {
                    width: 100%;
                    height: calc(100vh - 40px);
                    background: rgba(255, 26, 104, 0.2);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                  }
                  .chartBox {
                    width: calc(100%-20px);
                    padding: 20px;
                    border-radius: 20px;
                    border: solid 3px rgba(255, 26, 104, 1);
                    background: white;
                  }
                </style>
              </head>
              <body>
                <div class="chartCard">
                  <div class="chartBox">
                    <input type="date" onchange="startDateFilter(this)" value="2022-11-01" min="2022-11-01" max="2023-12-30">
                  
                    <input type="date" onchange="endDateFilter(this)" value="2022-12-30" min="2022-11-01" max="2023-12-30">
                    
                    <canvas id="myChart"></canvas>
                  </div>
                </div>

                <?php
                    
                    
                    $sql = 'SELECT order_date, SUM(due_amount) AS due_amount FROM kychienlaptop.customer_orders GROUP BY order_date';
                    $result = $con->query(($sql));

                    if($result->rowCount()>0){
                        while($row = $result->fetch()){
                            $dateArray[] = $row['order_date'];
                            $priceArray[] = $row['due_amount'];
                        }

                        unset($result);
                    }else {
                        echo 'Không có đơn hàng nào';
                    }
                
                    unset($con);
                ?>

                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

                <script>

                const dateArrayJS = <?php echo json_encode($dateArray); ?>;
                const dateChartJS = dateArrayJS.map((day,index)=>{
                    let dayjs = new Date(day);
                    return dayjs.setHours(0,0,0,0);
                });


                // setup 
                const data = {
                  labels: dateChartJS,
                  datasets: [{
                    label: 'Doanh thu',
                    data: <?php echo json_encode($priceArray); ?>,
                    backgroundColor: [
                      'rgba(255, 26, 104, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)',
                      'rgba(0, 0, 0, 0.2)'
                    ],
                    borderColor: [
                      'rgba(255, 26, 104, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)',
                      'rgba(0, 0, 0, 1)'
                    ],
                    borderWidth: 2
                  }]
                };

                // config 
                const config = {
                  type: 'line',
                  data,
                  options: {
                    scales: {
                      x:{
                        min: '2022-11-01',
                        max: '2023-12-30',
                        type: 'time',
                        time: {
                            unit:'day',
                        }
                      },
                      y: {
                        beginAtZero: true
                      }
                    },
                  
                    plugins: {
                        subtitle: {
                            display: true,
                            text: 'Bảng doanh thu theo ngày'
                        },
                        tooltip: {
                            callbacks: {
                                title : context =>{
                                    const d = new Date(context[0].parsed.x);
                                    const formattedDate = d.toLocaleString([],{
                                        day:'numeric',
                                        month:'short',
                                        year:'numeric'
                                    });
                                    return formattedDate;
                                },
                                label: function(context) {
                                    let label = context.dataset.label || '';

                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                  }
                };

                // render init block
                const myChart = new Chart(
                  document.getElementById('myChart'),
                  config
                );

                function startDateFilter(date){
                    const startDate = new Date(date.value);
                    myChart.config.options.scales.x.min = startDate.setHours(0,0,0,0);
                    myChart.update();
                }
                function endDateFilter(date){
                    const endDate = new Date(date.value);
                    myChart.config.options.scales.x.max = endDate.setHours(0,0,0,0); 
                    myChart.update();
                }
                </script>

              </body>
            </html>
            
            </div><!-- panel-body finish -->
            
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->


<?php } ?>