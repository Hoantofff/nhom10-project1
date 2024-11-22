<?php
class ProductController
{
    private $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function index()
    {
        $title = "Danh sách sản phẩm";
        $view = "products/index";
        $products = $this->product->getAll();
        return require_once PATH_VIEW_ADMIN_MAIN;
    }
    public function showProduct()
    {
        $title = "Sản phẩm chi tiết";
        $view = "products/show";
        $product = $this->product->getById($_GET['id']);
        return require_once PATH_VIEW_ADMIN_MAIN;
    }
    public function goToEdit()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }
            $view = 'products/edit';
            $title = "Cập nhật sản phẩm";
            $id = $_GET['id'];
            $brands = $this->product->getBrands();
            $categories = $this->product->getCategories();
            $product = $this->product->getByID($id);

            if (empty($product)) {
                throw new Exception("product có ID = $id KHÔNG TỒN TẠI!");
            }

            return require_once PATH_VIEW_ADMIN_MAIN;
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL_ADMIN . '&action=products-index');
            exit();
        }
    }
    public function startUpdate()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Phương Thức Phải Là POST');
            }
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số id', 99);
            }
            $id = $_GET['id'];

            $product = $this->product->find('*', 'id = :id', ['id' => $id]);

            if (empty($product)) {
                throw new Exception("product có Id = $id Không Tồn Tại");
            }
            $data = $_POST + $_FILES;

            $_SESSION['error'] = [];
            if ($data['price'] < $data['sale_price']) {
                $_SESSION['error']['logic_price'] = "Giá ban đầu phải lớn hơn giá đã giảm";
            }
            if (!empty($_SESSION['error'])) {
                $_SESSION['data'] = $data;
                throw new Exception('Dữ Liệu Lỗi');
            }
            if ($data['image']['size'] > 0) {
                $data['image'] = upload_file('img', $data['image']);
            } else {
                $data['image'] = $product['image'];
            }


            $data['updated_at'] = date('Y-m-d h:i:s');
            $data['discount'] = 100 - ceil(($data['sale_price'] / $data['price']) * 100);
            $rowcount = $this->product->update($data, 'id = :id', ['id' => $id]);

            if ($rowcount > 0) {
                if ($_FILES['image']['size'] > 0 && !empty($product['image']) && file_exists(PATH_ASSETS_UPLOADS . $product['image'])) {
                    unlink(PATH_ASSETS_UPLOADS . $product['image']);
                }
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao Tác Thành Công';
            } else {
                throw new Exception('Thao Tác Không Thành Công');
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            if ($th->getCode() == 99) {
                header('location: ' . BASE_URL_ADMIN . '&act=products-index');
                exit();
            }
        }
        header('location: ' . BASE_URL_ADMIN . '&act=products-edit&id=' . $id);
        exit();
    }
    public function goToCreate()
    {
        $title = "Thêm mới sản phẩm";
        $view = "products/create";
        $brands = $this->product->getBrands();
        $categories = $this->product->getCategories();
        return require_once PATH_VIEW_ADMIN_MAIN;
    }
    public function startCreate()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Phương Thức Phải Là POST');
            }
            $data = $_POST + $_FILES;

            $_SESSION['error'] = [];

            // Validate dữ liệu
            if (empty($data['name'])) {
                $_SESSION['error']['name'] = 'Trường name bắt buộc';
            }

            if (
                empty($data['price'])
            ) {
                $_SESSION['error']['price'] = 'Trường giá bắt buộc';
            }

            if (empty($data['sale_price'])) {
                $_SESSION['error']['sale_price'] = 'Trường giá sau khi giảm bắt buộc';
            }
            if ($data['price'] < $data['sale_price']) {
                $_SESSION['error']['logic_price'] = "Giá ban đầu phải lớn hơn giá đã giảm";
            }
            if (empty($data['description'])) {
                $_SESSION['error']['description'] = 'Trường mô tả sản phẩm không được bỏ trống';
            }
            if (empty($data['content'])) {
                $_SESSION['error']['content'] = 'Trường giới thiệu sản phẩm không được bỏ trống';
            }
            if ($data['image']['size'] > 0) {

                if ($data['image']['size'] > 2 * 1024 * 1024) {
                    $_SESSION['error']['image_size'] = 'Trường image có dung lượng tối đa 2MB';
                }
            }

            if (!empty($_SESSION['error'])) {
                $_SESSION['data'] = $data;
                throw new Exception('Dữ Liệu Lỗi');
            }

            if ($data['image']['size'] > 0) {
                $data['image'] = upload_file('img', $data['image']);
            } else {
                $data['image'] = null;
            }
            $data['discount'] = ceil($data['price'] / $data['sale_price'] * 100) - 100;
            $rowcount = $this->product->insert($data);

            if ($rowcount > 0) {
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao Tác Thành Công';
            } else {
                throw new Exception('Thao Tác Không Thành Công');
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
        }
        header('location: ' . BASE_URL_ADMIN . '&act=products-create');
        exit();
    }
    public function delete()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu Tham Số id', 99);
            }
            $id = $_GET['id'];

            $product = $this->product->find('*', 'id = :id', ['id' => $id]);

            if (empty($product)) {
                throw new Exception("product có Id = $id Không Tồn Tại");
            }

            $rowcount = $this->product->delete('id = :id', ['id' => $id]);

            if ($rowcount > 0) {
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao Tác Thành công';
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
        }

        header('location: ' . BASE_URL_ADMIN . '&act=products-index');
        exit();
    }
}
