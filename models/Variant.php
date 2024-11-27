<?php

class Variant extends BaseModel{
    protected $table = 'variant';

    public function getAll()
    {
        $sql = "SELECT  vr.id as v_id,
                        vr.product_id as vr_product_id,
                        vr.color_id as vr_color_id,
                        vr.size_id as vr_size_id,
                        vr.variant_price as vr_variant_price,
                        vr.variant_quantity as vr_variant_quantity,
                        sz.id as sz_id,
                        sz.size_value as sz_size_value,
                        cl.id as cl_id,
                        cl.color_value as cl_color_value
                FROM variant AS vr
                INNER JOIN size AS sz ON sz.id = vr.size_id
                INNER JOIN color AS cl ON cl.id = vr.color_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProductId($id){
        $sql = "SELECT  vr.id as v_id,
                        vr.product_id as vr_product_id,
                        vr.color_id as vr_color_id,
                        vr.size_id as vr_size_id,
                        vr.variant_price as vr_variant_price,
                        vr.variant_price_sale as vr_variant_price_sale,
                        vr.variant_quantity as vr_variant_quantity,
                        sz.id as sz_id,
                        sz.size_value as sz_size_value,
                        cl.id as cl_id,
                        cl.color_value as cl_color_value
                FROM variant AS vr
                INNER JOIN size AS sz ON sz.id = vr.size_id
                INNER JOIN color AS cl ON cl.id = vr.color_id
                WHERE vr.product_id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteProductId($id){
        $sql = "DELETE FROM `variant`
                WHERE vr.product_id = :product_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':productId', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSize()
    {
        $sql = "SELECT  * FROM size";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getColor()
    {
        $sql = "SELECT * FROM color";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}