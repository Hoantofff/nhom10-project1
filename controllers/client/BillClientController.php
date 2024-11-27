<?php

class BillClientController
{
    private $bill;
    private $cart;
    private $billDetail;
    protected $table;
    // protected $db;
    public function __construct()
    {
        // $this->home = new Home();
        $this->bill = new Bill();
        $this->billDetail = new BillDetail();
        $this->cart = new Cart();
        // $this->db = new PDO("mysql:host=localhost;dbname=my_database", "username", "password");
        // $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Bật chế độ báo lỗi
    }
    public function billList()
    {
        $statusLabels = [
            1 => 'Đang chờ xử lý',
            2 => 'Đang xử lý',
            3 => 'Vận chuyển',
            4 => 'Đã giao',
            5 => 'Đã hủy'
            ];
        $paymentLabels = [
            1 => 'COD',
            2 => 'Online'
        ];
        $view = "user/billList";
        $client_id = $_SESSION['user_client']['id'];
        $data = $this->bill->getByUserID($client_id);
        require_once PATH_VIEW_CLIENT . 'main.php';
    }
    public function billDetail()
    {
        $id=$_GET['id'];
        $statusLabels = [
            1 => 'Đang chờ xử lý',
            2 => 'Đang xử lý',
            3 => 'Vận chuyển',
            4 => 'Đã giao',
            5 => 'Đã hủy'
            ];
        $paymentLabels = [
            1 => 'COD',
            2 => 'Online'
        ];
        // $title="Chi tiết bill";
        $billData= $this->bill->getByID($id);
        $client_id = $_SESSION['user_client']['id'];
        $cartItems = $this->billDetail->getBillDetailsByBillId($id);
        $view = "user/billDetail";
        require_once PATH_VIEW_CLIENT . "main.php";
    }
    public function edit()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }
            $statusLabels = [
                1 => 'Pending',
                2 => 'Processing',
                3 => 'Shipped',
                4 => 'Delivered',
                5 => 'Cancelled'
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
            1 => 'Pending',
            2 => 'Processing',
            3 => 'Shipping',
            4 => 'Delivered',
            5 => 'Cancelled'
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
    
            // Điều hướng đến trang phù hợp
            if ($th->getCode() == 99) {
                header('location: ' . BASE_URL_ADMIN . '&act=bills-index');
            } else {
                header('location: ' . BASE_URL_ADMIN . '&act=bills-edit&id=' . $_GET['id']);
            }
            exit();
        }
    }
    // public function deleteClientBill()
    // {
    //     try {
    //         if (!isset($_GET['id'])) {
    //             throw new Exception('Thiếu Tham Số id', 99);
    //         }
    //         $id = $_GET['id'];

    //         $bill = $this->bill->find('*', 'id = :id', ['id' => $id]);
    //         if (empty($bill)) {
    //             throw new Exception("bill có Id = $id Không Tồn Tại");
    //         }

    //         $rowcount = $this->bill->delete('id = :id', ['id' => $id]);
    //         if ($rowcount > 0) {
    //             $_SESSION['success'] = true;
    //             $_SESSION['msg'] = 'Thao Tác Thành công';
    //         }
    //     } catch (\Throwable $th) {
    //         $_SESSION['success'] = false;
    //         $_SESSION['msg'] = $th->getMessage();
    //     }

    //     header('location: ' . BASE_URL_ADMIN . '&act=bills-index');
    //     exit();
    // }
    // Phương thức để thêm hóa đơn và chi tiết hóa đơn
    public function addBill() {
        try {
            // Kiểm tra nếu người dùng đã đăng nhập
            if (!isset($_SESSION['user_client']['id'])) {
                throw new Exception('Vui lòng đăng nhập để tiếp tục.');
            }
    
            // Lấy thông tin từ form và kiểm tra tính hợp lệ
            $user_name = isset($_POST['user_name']) ? trim($_POST['user_name']) : '';
            $user_address = isset($_POST['user_address']) ? trim($_POST['user_address']) : '';
            $user_phone = isset($_POST['user_phone']) ? trim($_POST['user_phone']) : '';
            $total = isset($_POST['total']) ? floatval($_POST['total']) : 0;
            $user_id = $_SESSION['user_client']['id'];
    
            // Kiểm tra các trường hợp bắt buộc
            if (empty($user_name)) {
                throw new Exception('Tên người nhận không được để trống.');
            }
    
            if (empty($user_address)) {
                throw new Exception('Địa chỉ nhận hàng không được để trống.');
            }
    
            if (empty($user_phone) || !preg_match('/^\d{9,10}$/', $user_phone)) {
                throw new Exception('Số điện thoại không hợp lệ. Vui lòng nhập lại.');
            }
    
            if ($total <= 0) {
                throw new Exception('Tổng tiền không hợp lệ.');
            }
    
            // 1. Thêm hóa đơn vào bảng `bill`
            $billId = $this->bill->addBill($user_name, $user_address, $user_phone, $total, $user_id);
    
            if (!$billId) {
                throw new Exception('Đã có lỗi xảy ra khi thêm hóa đơn. Vui lòng thử lại.');
            }
    
            // 2. Lấy thông tin giỏ hàng của người dùng
            $cartItems = $this->cart->getCart($user_id);
    
            // Kiểm tra nếu giỏ hàng rỗng
            if (empty($cartItems)) {
                throw new Exception('Giỏ hàng của bạn hiện tại không có sản phẩm.');
            }
    
            // 3. Thêm chi tiết hóa đơn vào bảng `bill_detail`
            foreach ($cartItems as $item) {
                $this->billDetail->addBillDetail($billId, $item['pd_id'], $item['pd_sale_price'], $item['pd_name'], $item['pd_image'], $item['c_quantity']);
            }
    
            // 4. Xóa giỏ hàng sau khi đặt hàng thành công (optional)
            $this->cart->clearCart($user_id);
            // Chuyển hướng về trang khác (ví dụ: trang cảm ơn hoặc đơn hàng của người dùng)
            header('Location: ' . BASE_URL . '?act=goToBill');
            exit();
        } catch (Exception $e) {
            // Nếu có lỗi, thiết lập thông báo lỗi
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $e->getMessage();
    
            // Chuyển hướng lại về trang trước đó hoặc trang giỏ hàng
            header('Location: ' . BASE_URL . '?act=goToCart');
            exit();
        }
    }
    public function deleteClientBill() {
        $id=$_GET['id'];
        $result=$this->bill->deleteClientBillCheck($id);

        if ($result['success']) {
            $_SESSION['success'] = true;
            $_SESSION['msg'] = $result['message'];
        } else {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $result['message'];
        }

        // Chuyển hướng về trang danh sách hóa đơn
        header("Location: " . BASE_URL . "?act=goToBill");
        exit;
        }
    
}