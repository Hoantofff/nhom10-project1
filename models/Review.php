<?php

class Review extends BaseModel
{
    protected $table = "review";

    public function getAll()
    {
        $sql = "SELECT  r.id,
                        r.user_id,
                        r.product_id,
                        r.comment,
                        r.rating,
                        r.created_at,
                        u.name as u_name,
                        u.id as u_id,
                        u.avatar as u_avatar,
                        pd.name  as pd_name,
                        pd.id  as pd_id
                FROM review AS r
                INNER JOIN users AS u ON u.id = r.user_id
                INNER JOIN products AS pd ON pd.id = r.product_id
                ORDER BY pd.name ASC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getReviewById( $productId)
    {
        $sql = "SELECT  r.id,
                        r.user_id,
                        r.product_id,
                        r.comment,
                        r.rating,
                        r.created_at,
                        u.name as u_name,
                        u.id as u_id,
                        u.avatar as u_avatar,
                        pd.name  as pd_name,
                        pd.id  as pd_id
                FROM review AS r
                INNER JOIN users AS u ON u.id = r.user_id
                INNER JOIN products AS pd ON pd.id = r.product_id
                WHERE pd.id = :product_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":product_id", $productId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}