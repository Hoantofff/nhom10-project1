<?php
class Home extends BaseModel
{
    public function renderCategory()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    private function selectTop5($id)
    {
        $sql_products = "SELECT 
                         pr.name, 
                         pr.discount, 
                         pr.image, 
                         pr.price, 
                         pr.sale_price, 
                         pr.id,
                         pr.category_id
                         FROM brands AS br
                         INNER JOIN products AS pr 
                         ON pr.brand_id = br.id
                         WHERE br.category_id = $id
                         ORDER BY pr.view_count DESC
                         LIMIT 5";
        $stmt_products = $this->pdo->prepare($sql_products);
        $stmt_products->execute();
        $products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);
        $sql_brands = "SELECT name 
                      FROM brands 
                      WHERE category_id = $id";
        $stmt_brands = $this->pdo->prepare($sql_brands);
        $stmt_brands->execute();
        $brands = $stmt_brands->fetchAll(PDO::FETCH_ASSOC);
        $sql_categories = "SELECT name 
                      FROM categories
                      WHERE id = $id";
        $stmt_categories = $this->pdo->prepare($sql_categories);
        $stmt_categories->execute();
        $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);
        return [
            'categories' => $categories,
            'products' =>  $products,
            "brands" =>  $brands
        ];
    }
    public function renderProductsAndTypes()
    {
        $sql = "SELECT MAX(category_id) AS max_category_id 
                FROM brands";
        $stmt =  $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxCategory = $result['max_category_id'];
        $data = [];
        for ($i = 1; $i <= $maxCategory; $i++) {
            $data[] = $this->selectTop5($i);
        }
        return $data;
    }
}
