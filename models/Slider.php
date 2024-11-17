<?php

class Slider extends BaseModel
{
    protected $table = 'sliders';

    public function getAll()
    {
        $sql = "
            SELECT 
                s.id AS s_id,
                s.img_slider AS s_img_slider,
                s.content AS s_content,
                s.created_at AS s_created_at,
                p.id AS p_id,
                p.name AS p_name
            FROM sliders s
            JOIN products p ON p.id = s.product_id
            ORDER BY s.id DESC
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
                s.id AS s_id,
                s.product_id AS s_product_id,
                s.img_slider AS s_img_slider,
                s.content AS s_content,
                s.created_at AS s_created_at,
                p.id AS p_id,
                p.name AS p_name
            FROM sliders s
            JOIN products p ON p.id = s.product_id
            WHERE s.id = :id;
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(['id' => $id]);

        $result = $stmt->fetch();
        return $result ?: null;
    }
    // public function getProducts($keyword = null)
    // {
    //     $sql = "SELECT id, name FROM products";
    //     if (!empty($keyword)) {
    //         $sql .= " WHERE name LIKE :keyword";
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     } else {
    //         return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    //     }
    // }
}
