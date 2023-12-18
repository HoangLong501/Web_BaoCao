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
    <div class="header">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
            <a href="index.php" class="navbar-brand">Drink Store</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>   
            </form>

            <?php
                error_reporting(0);
                $checked=$_POST['signed'];
                if(!$checked){
                   
                    echo "
                    <div class='signin'>
                    <a href='signin.php' class='btn btn-outline-success btnDangNhap' >Đăng nhập</a>

                </div>
                    ";
                    
                }else{
                    echo "
                    <div class='signup'>
                    <a href='index.php' class='btn btn-outline-success btnDangNhap' >Đăng xuất</a>

                </div>
                    ";
                    
                }
            ?>
                    
            
            </div>
        </nav>

    </div>



    <div class="content row">
        <div class="sidebar col-2 sidebar-edit">
            <ul class="nav flex-column">
                <?php
                include "config.php";
                $sql = "select * from manufacturer";
                $stm = $pdh->query($sql);
                $rows = $stm->fetchAll(PDO::FETCH_NUM);
                foreach ($rows as $row) {
                $temp=$row[0];
                echo "
                <li class='nav-item'>
                    <form method='GET'>
                    <input type='' name='sidebar' value='$temp' style='display:none' >
                    <button type='submit' class='nav-link' >$row[1]</button>
                    </form>
                </li>
                ";
                }
                $value_get=$_GET['sidebar'];
                

                ?>
            </ul>
        </div>

        <div class="product-sale col">
            <div class="title">
            <span>SALE 12/12</span> 
            </div>

            <div class="product row">
                <?php
                    include "config.php";
                    $value=$_GET["sidebar"];
                    
                    $sql2 = "select * from drink where manu_id='$value' ";
                    $stm3 = $pdh->query($sql2);
                    $rows3 = $stm3->fetchAll(PDO::FETCH_NUM);
                    
                    foreach($rows3 as $row11)
                    {
                        
                        echo "
                        <div class='card col-3' style='width: 18rem;'>
                            <img src='./img_product/$row11[4]' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$row11[1]</h5>
                                    <p class='card-text'>Giá bán $row11[2]$</p>
                                    <a href='#' class='btn btn-primary'>Thêm vào giỏ hàng</a>
                                </div>
                        </div>
                        ";  
                    }

                ?>
            </div>
        </div>
      

    </div>

    


    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="scripts.js"></script>
</html>