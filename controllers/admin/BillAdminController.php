<?php

class BillAdminController
{
    private $bill;
    private $cart;
    protected $table;
    // protected $db;
    public function __construct()
    {
        // $this->home = new Home();
        $this->bill = new Bill();
        $this->cart = new Cart();
        // $this->db = new PDO("mysql:host=localhost;dbname=my_database", "username", "password");
        // $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Bật chế độ báo lỗi
    }
    public function billList()
    {
        $view = "user/billList";
        $data = $this->bill->getAll();
        $statusLabels = [
            1 => 'Chờ xử lí',
            2 => 'Đã xử lí',
            3 => 'Đang giao hàng',
            4 => 'Đã thanh toán',
            5 => 'Hủy đơn'
        ];
        // $client_id = $_SESSION['user-client']['id'];
        // $data = $this->bill->getByID($client_id);
        require_once PATH_VIEW_CLIENT . 'main.php';
    }
    public function billDetail()
    {
        $client_id = $_SESSION['user-client']['id'];
        $data = $this->bill->getByID($client_id);
        $view = "user/billDetail";
        require_once PATH_VIEW_CLIENT . "main.php";
    }
    public function index()
    {   
        $statusLabels = [
            1 => 'Chờ xử lí',
            2 => 'Đã xử lí',
            3 => 'Đang giao hàng',
            4 => 'Đã thanh toán',
            5 => 'Hủy đơn'
            ];
        $paymentLabels = [
            1 => 'COD',
            2 => 'Online'
        ];
        $view = 'bills/index';
        $title = 'Danh Sách bill';
        $data = $this->bill->getAll();
        require_once PATH_VIEW_ADMIN_MAIN;
    }
    public function edit()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }
            $statusLabels = [
                1 => 'Chờ xử lí',
                2 => 'Đã xử lí',
                3 => 'Đang giao hàng',
                4 => 'Đã thanh toán',
                5 => 'Hủy đơn'
                ];
                $paymentLabels = [
                    1 => 'COD',
                    2 => 'Online'
                ];
            $view = 'bills/edit';
            $title = "Cập nhật bill";
            $id = $_GET['id'];
            $bill = $this->bill->getPersonalBillAdmin($id);
            if (empty($bill)) {
                throw new Exception("bill có ID = $id KHÔNG TỒN TẠI!");
            }

            return require_once PATH_VIEW_ADMIN_MAIN;
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL_ADMIN . '&action=bills-index');
            exit();
        }
    }
    public function show() {
        $statusLabels = [
            1 => 'Chờ xử lí',
            2 => 'Đã xử lí',
            3 => 'Đang giao hàng',
            4 => 'Đã thanh toán',
            5 => 'Hủy đơn'
            ];
        $paymentLabels = [
            1 => 'COD',
            2 => 'Online'
        ];
        $view = 'bills/show';
        $title = 'Bill chi tiết';
        $data = $this->bill->getPersonalBillAdmin($_GET['id']);
        require_once PATH_VIEW_ADMIN_MAIN;
    }
    public function update() {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Phương thức phải là POST');
            }
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu Tham Số id', 99);
            }
            $id = $_GET['id'];
            $bill = $this->bill->find('*', 'id = :id', ['id' => $id]);
            if (empty($bill)) {
                throw new Exception("Bill có Id = $id Không Tồn Tại");
            }
            $data = $_POST;
            $_SESSION['error'] = [];
    
            if (empty($data['bill_status'])) {
                $_SESSION['error']['status']="Không thể chọn trùng trạng thái";
            }
            if($data['bill_status'] <= $bill['bill_status']) {
                $_SESSION['error']['status']="Không thể quay ngược hay giữ nguyên trạng thái";
            }
            if (!empty($_SESSION['error'])) {
                header('location: ' . BASE_URL_ADMIN . '&act=bills-edit&id=' . $id);
                throw new Exception('Dữ Liệu Lỗi');
            }
            $rowcount = $this->bill->updateBillStatus($id, $data['bill_status']);
            if ($rowcount > 0) {
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao Tác Thành Công';
                header('location: ' . BASE_URL_ADMIN . '&act=bills-index');
            } else {
                throw new Exception('Thao Tác Không Thành Công');
            }
        } catch (\Throwable $th) {
            // Xử lý lỗi
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
    
            // Check
            if ($th->getCode() == 99) {
                header('location: ' . BASE_URL_ADMIN . '&act=bills-index');
            } else {
                header('location: ' . BASE_URL_ADMIN . '&act=bills-edit&id=' . $_GET['id']);
            }
            exit();
        }
    }
    public function delete()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu Tham Số id', 99);
            }
            $id = $_GET['id'];

            $bill = $this->bill->find('*', 'id = :id', ['id' => $id]);
            if (empty($bill)) {
                throw new Exception("bill có Id = $id Không Tồn Tại");
            }

            $rowcount = $this->bill->delete('id = :id', ['id' => $id]);
            if ($rowcount > 0) {
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao Tác Thành công';
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
        }

        header('location: ' . BASE_URL_ADMIN . '&act=bills-index');
        exit();
    }
}