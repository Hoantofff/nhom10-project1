<?php

class SliderController
{
    private $slider;
    private $product;
    public function __construct()
    {
        $this->slider = new Slider();
        // $this->product = new Product();
    }
    public function index()
    {
        $view = 'sliders/index';
        $title = 'Danh Sách Slider';
        $data = $this->slider->getAll();

        require_once PATH_VIEW_ADMIN_MAIN;
    }
    public function edit()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }
            $id = $_GET['id'];
            $slider = $this->slider->getByID($id);
            if (empty($slider)) {
                throw new Exception("slider có ID = $id KHÔNG TỒN TẠI!");
            }
            $view = 'sliders/edit';
            $title = "Cập nhật slider có ID = $id";
            require_once PATH_VIEW_ADMIN_MAIN;
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL_ADMIN . '&act=sliders-index');
            exit();
        }
    }
    public function update()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Phương thức phải là POST');
            }

            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }

            $id = $_GET['id'];
            $slider = $this->slider->getByID($id);

            if (empty($slider)) {
                throw new Exception("Slider có ID = $id không tồn tại");
            }

            $data = $_POST + $_FILES;
            $_SESSION['error'] = [];

            // Kiểm tra dữ liệu nhập vào
            if (empty($data['product_id'])) {
                $_SESSION['error']['product_id'] = 'Trường id sản phẩm bắt buộc';
            }

            if (empty($data['content']) || strlen($data['content']) < 20) {
                $_SESSION['error']['content'] = 'Trường "content" bắt buộc và độ dài phải hơn 20 kí tự';
            }

            // Kiểm tra ảnh
            if ($data['img_slider']['size'] > 0) {
                if ($data['img_slider']['size'] > 2 * 1024 * 1024) {
                    $_SESSION['error']['img_slider_size'] = 'Trường avatar có dung lượng tối đa 2MB';
                }

                $fileType = $data['img_slider']['type'];
                $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($fileType, $allowedTypes)) {
                    $_SESSION['error']['img_slider_type'] = 'Xin lỗi, chỉ chấp nhận các loại file JPG, JPEG, PNG, GIF.';
                }
            }
            if ($data['img_slider']['size'] > 0) {
                $data['img_slider'] = upload_file('sliders', $data['img_slider']);
            } else {
                $_SESSION['error']['img_slider_null'] = 'Không được phép để ảnh trống';
            }            
            if (!empty($_SESSION['error'])) {
                $_SESSION['data'] = $data;
                header('location: ' . BASE_URL_ADMIN . '&act=sliders-edit&id='.$id);
                throw new Exception('Dữ Liệu Lỗi');
            }


            $data['created_at'] = date('Y-m-d h:i:s');

            $rowcount = $this->slider->update($data, 'id = :id', ['id' => $id]);

            if ($rowcount > 0) {
                if ($_FILES['img_slider']['size'] == 0 || $_FILES['img_slider']['size'] > 0 && !empty($slider['img_slider']) && file_exists(PATH_ASSETS_UPLOADS . $slider['img_slider'])) {
                    unlink(PATH_ASSETS_UPLOADS . $slider['img_slider']);
                }
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao Tác Thành Công';
                header('location: ' . BASE_URL_ADMIN . '&act=sliders-index');
            } else {
                throw new Exception('Thao Tác Không Thành Công');
                header('location: ' . BASE_URL_ADMIN . '&act=sliders-edit&id='.$id);
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            if ($th->getCode() == 99) {
                header('location: ' . BASE_URL_ADMIN . '&act=sliders-index');
                exit();
            }
        }
    }
    // public function getProductList()
    // {
    //     $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : null;
    //     $products = $this->product->getProducts($keyword);
    //     echo json_encode($products);
    //     exit;
    // }
}
