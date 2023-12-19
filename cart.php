<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/nova-square" rel="stylesheet">
                
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    .title{
        font-size: 20px;
        width: 100%;
        font-family: 'Nova Square', sans-serif;
        
    }
    .card{
        margin-left: 12px;
    }


</style>

<body>
<?php

    
?>



    <div class="header">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
            <a href="index.php" class="navbar-brand">Drink Store</a>
            

            <?php
                error_reporting(0);
                $checked=$_POST['signed'];
                if(!$checked){
                    echo "
                    <div class='signup'>
                    <a href='index.php' class='btn btn-outline-success btnDangNhap' >Đăng xuất</a>

                </div>
                    ";
                    
                    
                }else{
                    
                    echo "
                    <div class='signin'>
                    <a href='signin.php' class='btn btn-outline-success btnDangNhap' >Đăng nhập</a>

                </div>
                
                    
                    ";
                }
            ?>
                    
            
            </div>
        </nav>

    </div>



    <div class="content row">
        <div class="product-cart col">
            <div class="title">
            <span><h1><center>THÔNG TIN GIỎ HÀNG</center></h1> </span> 
            </div>

           


            <section class="vh-100" style="background-color: #fdccbc;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">

        <?php
                    include "config.php";
                    $sql = "SELECT d.drink_name, d.img, od.quantity, d.price , 
                    od.quantity*d.price as total FROM drink d JOIN order_detail od ON d.drink_id = od.drink_id;";
                    $stm = $pdh->query($sql);
                    $rows = $stm->fetchAll(PDO::FETCH_OBJ);
                    $count=sizeof($rows);
                    echo "<p><span class='h4'>Shopping Cart </span><span class='h4'>($count item in your cart)</span></p>";
                    foreach($rows as $row)
                    {
                        
                        echo "
                        
                        <div class='card mb-4'>
          <div class='card-body p-4'>

            <div class='row align-items-center'>
              <div class='col-md-2'>
                <img src='./img_product/$row->img'
                  class='img-fluid' style='max-width: 50%' alt='Generic placeholder image'>
              </div>
              <div class='col-md-2 d-flex justify-content-center'>
                <div>
                  <p class='small text-muted mb-4 pb-2'>Name</p>
                  <p class='lead fw-normal mb-0'>$row->drink_name</p>
                </div>
              </div>
              <div class='col-md-2 d-flex justify-content-center'>
                <div>
                  <p class='small text-muted mb-4 pb-2'>Quantity</p>
                  <p class='lead fw-normal mb-0'>$row->quantity</p>
                </div>
              </div>
              <div class='col-md-2 d-flex justify-content-center'>
                <div>
                  <p class='small text-muted mb-4 pb-2'>Price</p>
                  <p class='lead fw-normal mb-0'>$row->price</p>
                </div>
              </div>
              <div class='col-md-2 d-flex justify-content-center'>
                <div>
                  <p class='small text-muted mb-4 pb-2'>Total</p>
                  <p class='lead fw-normal mb-0'>$row->total</p>
                </div>
              </div>
            </div>

          </div>
        </div>



                        ";  
                    }
                ?>



        

        







        <div class="card mb-5">
          <div class="card-body p-4">
                <?php

                    $sql = "SELECT 
                    SUM(d.price * od.quantity) AS total
                FROM 
                    drink d
                JOIN 
                    order_detail od ON d.drink_id = od.drink_id;";
                    $stm = $pdh->query($sql);
                    $rows = $stm->fetchAll(PDO::FETCH_OBJ);
                    
                    $total= $rows[0]->total;
                    echo "
                    <div class='float-end'>
                        <p class='mb-0 me-5 d-flex align-items-center'>
                          <span class='small text-muted me-2'>Order total:</span> <span
                            class='lead fw-normal'>$total</span>
                        </p>
                      </div>
                    
                    ";
                ?>
            
            
          </div>
        </div>

        <div class="d-flex justify-content-end">
          <button type="button" class="btn btn-light btn-lg me-2">Continue shopping</button>
          <button type="button" class="btn btn-primary btn-lg">Add to cart</button>
        </div>

      </div>
    </div>

</section>



                
            </div>
        </div>
      

    </div>

    


    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="scripts.js"></script>
</html>