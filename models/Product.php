<?php
class Product extends BaseModel
{
    protected $table = "products";
    public function getAll()
    {
        $sql = "SELECT pd.name, 
                       pd.image, 
                       pd.id, 
                       pd.price, 
                       pd.sale_price, 
                       br.name AS brand_name,
                       cy.name AS category_name,
                       pd.view_count
                FROM brands AS br
                INNER JOIN categories AS cy ON cy.id = br.category_id
                INNER JOIN products AS pd ON pd.brand_id = br.id
                ORDER BY pd.view_count DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id)
    {
        $sql = "SELECT pd.name, 
                       pd.image, 
                       pd.id, 
                       pd.price, 
                       pd.sale_price, 
                       br.name AS brand_name,
                       cy.name AS category_name,
                       pd.brand_id,
                       pd.category_id,
                       pd.view_count,
                       pd.discount,
                       pd.description,
                       pd.content,
                       pd.created_at,
                       pd.updated_at
                FROM brands AS br
                INNER JOIN categories AS cy ON cy.id = br.category_id
                INNER JOIN products AS pd ON pd.brand_id = br.id
                WHERE pd.id = $id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getBrands()
    {
        $sql = "SELECT br.name, 
                       br.id, 
                       cy.name as category_name
                FROM brands AS br
                INNER JOIN categories as cy ON cy.id = br.category_id";
        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCategories()
    {
        $sql = "SELECT name,
                       id
              FROM categories";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}