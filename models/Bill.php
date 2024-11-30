<?php

use function PHPSTORM_META\elementType;

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
                user_email,
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
                user_email,
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
                user_email,
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
            user_email,
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
    public function addBill($user_name, $user_email, $user_address, $user_phone, $total, $user_id) {
        $bill_status = 1;
        $payment_type = 1;
        $sql = "INSERT INTO bill (create_at, bill_status, payment_type, user_id, user_name, user_email, user_address, user_phone, total)
                VALUES (CURRENT_TIMESTAMP, :bill_status, :payment_type, :user_id, :user_name, :user_email, :user_address, :user_phone, :total)";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute([
            'bill_status' => $bill_status,
            'payment_type' => $payment_type,
            'user_id' => $user_id,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'user_address' => $user_address,
            'user_phone' => $user_phone,
            'total' => $total
        ])) {
            return $this->pdo->lastInsertId();
        }
        return false;
    }
    public function deleteClientBillCheck($bill_id)
    {   
        $userId = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id'] ?? null;
        if(!$userId) {
            return 1;
        }
        $checkBillStatus = "SELECT bill_status,user_id FROM bill WHERE id = :bill_id";
        $stmt = $this->pdo->prepare($checkBillStatus);
        $stmt->execute(['bill_id' => $bill_id]);
        $bill = $stmt->fetch();
        if (!$bill || $userId!=$bill['user_id']) {
            return 2;
        } else if($bill['bill_status'] != 1) {
            return 3;
        } else {
            $deleteSql = "DELETE FROM bill WHERE id = :bill_id";
            $stmt = $this->pdo->prepare($deleteSql);
            $result = $stmt->execute(['bill_id' => $bill_id]);
            if ($result) {return 3;}
        }
    }
    public function deleteBillCheck($bill_id)
    {   
        $userId = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id'] ?? null;
        if(!$userId) {
            return [
                'success' => false,
                'message' => 'Không xác định được người dùng. Vui lòng đăng nhập lại.'
            ];
        }
            $checkBillStatus = "SELECT bill_status,user_id FROM bill WHERE id = :bill_id";
            $stmt = $this->pdo->prepare($checkBillStatus);
            $stmt->execute(['bill_id' => $bill_id]);
            $bill = $stmt->fetch();

            if (!$bill || $bill['bill_status'] != 1 || $userId!=$bill['user_id']) {
                return [
                    'success' => false,
                    'message' => 'Hóa đơn không thể xóa. Chỉ xóa được hóa đơn chưa thanh toán thuộc quyền sở hữu của bạn.'
                ];
            }

            $deleteSql = "DELETE FROM bill WHERE id = :bill_id";
            $stmt = $this->pdo->prepare($deleteSql);
            $deleteSuccess = $stmt->execute(['bill_id' => $bill_id]);

            if ($deleteSuccess) {
                return [
                    'success' => true,
                    'message' => 'Hóa đơn đã được xóa thành công.'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Có lỗi xảy ra khi xóa hóa đơn. Vui lòng thử lại sau.'
                ];
            }
    }
}
