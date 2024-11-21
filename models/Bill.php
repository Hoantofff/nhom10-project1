<?php

class Bill extends BaseModel
{
    protected $table = 'bills';

    public function getAll()
    {
        $sql = "
            SELECT 
                id,
                bill_status,
                payment_type,
                payment_status,
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
                bill_status,
                payment_type,
                payment_status,
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

        $result = $stmt->fetch();
        return $result ?: null;
    }
}