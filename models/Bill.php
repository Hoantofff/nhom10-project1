<?php

class Bill extends BaseModel
{
    protected $table = 'bill';

    public function getAll()
    {
        $sql = "
            SELECT 
                id,
                create_at,
                bill_status,
                payment_type,
                user_id,
                user_name,
                user_address,
                user_phone,
                total
            FROM bill;
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result ?: [];
    }
    public function getByID($id)
    {
        $sql = "
            SELECT 
                id,
                create_at,
                bill_status,
                payment_type,
                user_name,
                user_address,
                user_phone,
                total
            FROM bill
            WHERE bill.id = :id;
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch();
        return $result ?: null;
    }
    public function getByUserID($id)
    {
        $sql = "
            SELECT 
                id,
                create_at,
                bill_status,
                payment_type,
                user_id,
                user_name,
                user_address,
                user_phone,
                total
            FROM bill
            WHERE bill.user_id = :id;
        ";
    
        $stmt = $this->pdo->prepare($sql);
    
        $stmt->execute(['id' => $id]);
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Luôn trả về danh sách mảng
        return $result ?: []; // Trả về mảng rỗng nếu không có bản ghi
    }
    public function getPersonalBillAdmin($id) {
        $sql="
        SELECT 
            id,
            create_at,
            bill_status,
            payment_type,
            user_id,
            user_name,
            user_address,
            user_phone,
            total
        FROM 
            bill
        WHERE id = :id;
    ";
    $stmt = $this->pdo->prepare($sql);

    $stmt->execute(['id' => $id]);

    $result = $stmt->fetch();
    return $result ?: null;
    }
    public function updateBillStatus($id, $billStatus) {
        $sql = "
            UPDATE bill 
            SET bill_status = :bill_status 
            WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
    
        $stmt->execute([
            'id' => $id,
            'bill_status' => $billStatus
        ]);
        return $stmt->rowCount();
    }
    public function canUpdateOrder($order) {
        // Kiểm tra trạng thái đơn hàng
        if ($order['bill_status'] != 1) {
            return false;
        }
    
        // Kiểm tra phương thức thanh toán
        if ($order['payment_type'] == 1) {
            return true; // Nếu là COD, cho phép cập nhật
        }
    
        // Kiểm tra thời gian đặt hàng
        // $orderTime = strtotime($order['created_at']);
        // $currentTime = time();
        // $timeDiff = $currentTime - $orderTime;
    
        // if ($timeDiff > 7200) { // Quá 2 giờ, không cho phép
        //     return false;
        // }
    
        return true;
    }
    public function addBill($user_name, $user_address, $user_phone, $total, $user_id) {
        // Set các giá trị cố định
        $bill_status = 1;  // Trạng thái hóa đơn (1: Chưa thanh toán)
        $payment_type = 1; // Hình thức thanh toán (1: Thanh toán khi nhận hàng)
    
        // Câu lệnh SQL để thêm hóa đơn vào bảng `bill`
        $sql = "INSERT INTO bill (create_at, bill_status, payment_type, user_id, user_name, user_address, user_phone, total)
                VALUES (CURRENT_TIMESTAMP, :bill_status, :payment_type, :user_id, :user_name, :user_address, :user_phone, :total)";
    
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->pdo->prepare($sql);
    
        // Thực thi câu lệnh với các tham số đã chuẩn bị
        if ($stmt->execute([
            'bill_status' => $bill_status,
            'payment_type' => $payment_type,
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_address' => $user_address,
            'user_phone' => $user_phone,
            'total' => $total
        ])) {
            // Trả về ID của hóa đơn vừa được tạo
            return $this->pdo->lastInsertId();
        }
    
        return false;
    }
    public function deleteClientBillCheck($bill_id)
{
    // Kiểm tra điều kiện: bill_status phải bằng 1
    $checkSql = "SELECT bill_status FROM bill WHERE id = :bill_id";
    $stmt = $this->pdo->prepare($checkSql);
    $stmt->execute(['bill_id' => $bill_id]);
    $bill = $stmt->fetch();

    // Nếu không tìm thấy hóa đơn hoặc bill_status khác 1, trả về lỗi
    if (!$bill || $bill['bill_status'] != 1) {
        return [
            'success' => false,
            'message' => 'Hóa đơn không thể xóa. Chỉ xóa được hóa đơn chưa thanh toán.'
        ];
    }

    // Xóa hóa đơn
    $deleteSql = "DELETE FROM bill WHERE id = :bill_id";
    $stmt = $this->pdo->prepare($deleteSql);
    $result = $stmt->execute(['bill_id' => $bill_id]);

    // Trả về kết quả
    if ($result) {
        return true;
    } else {
        return false;
    }
}
}
