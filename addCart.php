<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ biểu mẫu
    $drinkID = $_POST["drinkID"];
    
    
    // Xử lý dữ liệu (ví dụ: có thể lưu vào giỏ hàng hoặc cơ sở dữ liệu)
    // Ví dụ: Lưu vào session giỏ hàng
    include "config.php";
    $sql1="select drink_id from order_detail WHERE drink_id=$drinkID";
    $stm = $pdh->query($sql1);
    $rows = $stm->fetchAll(PDO::FETCH_NUM);
    if(sizeof($rows)>0){
        $sql ="UPDATE `order_detail` SET `quantity`=`quantity`+1 WHERE drink_id=$drinkID";
        $stm = $pdh->query($sql);
        echo "Cập nhật thành công";
    }else{
        $sql = "INSERT INTO `order_detail`(`order_id`, `drink_id`, `quantity`) VALUES ('OD1','$drinkID',1)";
        $stm = $pdh->query($sql);
        echo "Thêm thành công";
    }
    // Phản hồi về trang gửi yêu cầu Ajax
} else {
    // Nếu không phải là yêu cầu POST, có thể thực hiện các xử lý khác ở đây (nếu cần)
}
?>