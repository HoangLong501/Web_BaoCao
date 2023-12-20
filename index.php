<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/nova-square" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    .title {
        font-size: 20px;
        width: 100%;
        font-family: 'Nova Square', sans-serif;

    }

    .card {
        margin-left: 12px;
    }
</style>

<script>
    function submitForm(id) {
        // Lấy dữ liệu từ biểu mẫu
        var formData = $(".formCart").serialize();
        formData += "&drinkID=" + id;
        // Sử dụng Ajax để gửi yêu cầu đến server-side PHP
        $.ajax({
            type: "POST",
            url: "addCart.php", // Tên tệp xử lý PHP
            data: formData,
            success: function(respone) {
                alert(respone); // Hiển thị kết quả từ server
                
            }
        });
    }

    function navForm(id) {
            // Lấy dữ liệu từ biểu mẫu
           
            let formData = $(".formCart").serialize();
            formData += "&drinkNavID=" + id;
            // Sử dụng Ajax để gửi yêu cầu đến server-side PHP
            $.ajax({
                type: "POST",
                url: "search_sidebar.php", // Tên tệp xử lý PHP
                data: formData,
                success: function(respone) {
                    document.getElementById("product").innerHTML = respone;// Hiển thị kết quả từ server
                }
            });
        }
</script>







<body>
    <div class="header ">
        <nav class="navbar bg-body-tertiary ">
            <div class="container-fluid row">
                <div class="home col"><a href="index.php" class="navbar-brand ">Drink Store</a></div>

                <form class="d-flex col-6" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <div class="task row col-4">
                    <?php
                    error_reporting(0);

                    session_start();
                    if (!isset($_SESSION['user_id'])) { //nếu chưa đăng nhập -> hiện nút đăng nhập
                        echo $_SESSION['user_id'];  
                        echo "
                    <div class='signin col'>
                    <a href='signin.php' class='btn btn-outline-success btnDangNhap' >Đăng nhập</a>

                </div>
                
                    ";
                    } else {//nếu dã đăng nhập -> hiện nút giỏ hàng và đăng xuất
                        echo $_SESSION['user_id'];  
                        echo "
                    
                    <div class='signin col'>
                    <a href='cart.php' class='btn btn-outline-success btnDangNhap' >Giỏ hàng</a>
                    </div>
                    
                    <div class='signup col'>
                    <a href='signout.php' class='btn btn-outline-success btnDangNhap' >Đăng xuất</a>
                    </div>
                    ";
                    }
                    ?>
                </div>



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
                $rows12 = $stm->fetchAll(PDO::FETCH_OBJ);
                foreach ($rows12 as $row4) {

                $idSB=$row4->manu_id;
               
                echo "


                <li class='nav-item'>
                    <form class='navForm'>
                    <input name='testID' id='navIP' type='hidden' value='$idSB'>
                    <button type='button'onclick='navForm(\"$idSB\")' id='btnNav' class='nav-link ' >$row4->manu_name</button>
                    </form>
                </li>
                ";
                }
                
                

                ?>
            </ul>
        </div>

        <div class="product-sale col">
            <div class="title">
                <span>SALE 12/12</span>
            </div>

            <div id="product" class="product row">
                <?php
                include "config.php";
                session_start();
                $sql = "select * from drink ";
                $stm = $pdh->query($sql);
                $rows = $stm->fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                    $title = $row->drink_name;
                    $id = $row->drink_id;
                    $price = $row->price;

                    echo "
                        <div class='card col-3' style='width: 18rem;'>
                            <form class='formCart'   >
                                <img src='./img_product/$row->img' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$title</h5>
                                    <p class='card-text'>Giá bán $price $</p>
                                    <button type='button' onclick='submitForm($id)'class='btn btn-primary btnNav' >Thêm vào giỏ hàng</button>
                                </div>
                            </form>
                        </div>
                        ";
                }

                ?>


            </div>

        </div>
        <div class="product-bestseller"></div>
        <div class="product-1"></div>
        <div class="product-2"></div>

    </div>



</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="scripts.js"></script>

</html>