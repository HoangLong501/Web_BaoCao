<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ biểu mẫu
    $removeID = $_POST["removeID"];
    // Xử lý dữ liệu (ví dụ: có thể lưu vào giỏ hàng hoặc cơ sở dữ liệu)
    // Ví dụ: Lưu vào session giỏ hàng
   
    include "config.php";
    $sql1="select drink_id from order_detail WHERE drink_id=$removeID";
    $stm = $pdh->query($sql1);
    $rows = $stm->fetchAll(PDO::FETCH_NUM);
    if(sizeof($rows)>0){
        $sql ="DELETE FROM `order_detail` WHERE drink_id=$removeID";
        $stm = $pdh->query($sql);
        echo "Xóa thành công";
    }else{
        echo "Xóa thất bại";
    }
    // Phản hồi về trang gửi yêu cầu Ajax
} else {
    // Nếu không phải là yêu cầu POST, có thể thực hiện các xử lý khác ở đây (nếu cần)
    echo"Loi    ";
}
?>