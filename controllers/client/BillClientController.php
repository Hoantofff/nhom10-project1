<?php

class BillClientController
{
    private $bill;
    private $cart;
    private $billDetail;
    private $variant;
    protected $table;
    public function __construct()
    {
        $this->bill = new Bill();
        $this->billDetail = new BillDetail();
        $this->cart = new Cart();
        $this->variant = new Variant();
    }
    public function billList()
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
        $view = "user/billList";
        $client_id = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id']  ?? null;
        $data = $this->bill->getByUserID($client_id);
        require_once PATH_VIEW_CLIENT . 'main.php';
    }
    public function billDetail()
    {
        $id = $_GET['id'];
        $billData = $this->bill->getByID($id);
        $client_id = $_SESSION['user_client']['id'];
        $cartItems = $this->billDetail->getBillDetails($id);
        $view = "user/billDetail";
        require_once PATH_VIEW_CLIENT . "main.php";
    }
    public function addBill()
    {
        // Lấy thông tin từ form và kiểm tra tính hợp lệ
        $user_name = isset($_POST['user_name']) ? trim($_POST['user_name']) : '';
        $user_email = isset($_POST['user_email']) ? trim($_POST['user_email']) : '';
        $user_address = isset($_POST['user_address']) ? trim($_POST['user_address']) : '';
        $user_phone = isset($_POST['user_phone']) ? trim($_POST['user_phone']) : '';
        $total = isset($_POST['total']) ? floatval($_POST['total']) : 0;
        $user_id = $userId = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id'] ?? null;;

        // Kiểm tra các trường hợp bắt buộc
        if (empty($user_name)) {
            $_SESSION['error'][] = 'Tên người nhận không được để trống.';
            header('Location: ' . BASE_URL . '?act=goToPayment');
            exit();
        }
        if (empty($user_email)) {
            $_SESSION['error'][] = 'Email người nhận không được để trống.';
            header('Location: ' . BASE_URL . '?act=goToPayment');
            exit();
        }
        if (empty($user_address)) {
            $_SESSION['error'][] = 'Địa chỉ nhận hàng không được để trống.';
            header('Location: ' . BASE_URL . '?act=goToPayment');
            exit();
        }
        if (empty($user_phone) || !preg_match('/^\d{9,10}$/', $user_phone)) {
            $_SESSION['error'][] = 'Số điện thoại không hợp lệ. Vui lòng nhập lại.';
            header('Location: ' . BASE_URL . '?act=goToPayment');
            exit();
        }
        if ($total <= 0) {
            $_SESSION['error'][] = 'Tổng tiền không hợp lệ.';
            header('Location: ' . BASE_URL . '?act=goToPayment');
            exit();
        }
        // Thêm hóa đơn vào bảng bill
        $billId = $this->bill->addBill($user_name, $user_email, $user_address, $user_phone, $total, $user_id);

        if (!$billId) {
            $_SESSION['error'][] = 'Đã có lỗi xảy ra khi thêm hóa đơn. Vui lòng thử lại.';
            header('Location: ' . BASE_URL . '?act=goToPayment');
            exit();
        }
        // Lấy thông tin giỏ hàng của người dùng
        $cartItems = $this->cart->getCart($user_id);

        // Kiểm tra nếu giỏ hàng rỗng
        if (empty($cartItems)) {
            $_SESSION['error'][] = 'Giỏ hàng của bạn hiện tại không có sản phẩm.';
            header('Location: ' . BASE_URL . '?act=goToPayment');
            exit();
        }

        // Thêm chi tiết hóa đơn vào bảng `bill_detail`
        foreach ($cartItems as $item) {
            $this->billDetail->addBillDetail($billId, $item['pd_id'], $item['pd_sale_price'], $item['pd_name'], $item['pd_image'], $item['variant_id'], $item['c_quantity']);
            $result = $this->variant->decreaseVariantQuantity($item['variant_id'], $item['c_quantity']);
            if (!$result) {
                $_SESSION['error'][] = "Không thể giảm số lượng cho biến thể ID:{$item['variant_id']}.";
                header('location:' . BASE_URL . '?act=goToPayment');
            }
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công (optional)
        $this->cart->clearCart($user_id);
        // Chuyển hướng về trang khác (ví dụ: trang cảm ơn hoặc đơn hàng của người dùng)
        header('Location: ' . BASE_URL . '?act=goToBill');
        exit();
    }
    public function deleteClientBill()
    {
        $bill_id = $_GET['id'] ?? null;
        $userId = $_SESSION['user_client']['id'] ?? $_SESSION['user_admin']['id'] ?? null;
        // kiểm tra id người dùng
        if (!$userId) {
            $_SESSION['error'] = 'Không xác định được người dùng. Vui lòng đăng nhập lại.';
            header("Location: " . BASE_URL . "?act=goToBill");
            exit;
        }
        // lấy thông tin hóa đơn
        $bill = $this->bill->getBillStatusAndOwner($bill_id);
        // kiểm tra trạng thái hóa đơn và quyền sở hữu
        if (!$bill || $userId != $bill['user_id']) {
            $_SESSION['error'] = 'Hóa đơn không thể xóa. Chỉ xóa được hóa đơn chưa thanh toán thuộc quyền sở hữu của bạn.';
            header("Location: " . BASE_URL . "?act=goToBill");
            exit;
        } elseif ($bill['bill_status'] != 1) {
            $_SESSION['error'] = 'Hóa đơn không thể xóa. Chỉ xóa được hóa đơn chưa được xử lí';
            header("Location: " . BASE_URL . "?act=goToBill");
            exit;
        }
        $billDetails = $this->billDetail->getBillDetailsByBillId($bill_id);
        // hoàn trả số lượng
        foreach ($billDetails as $detail) {
            $this->variant->increaseVariantQuantity($detail['variant_id'], $detail['quantity']);
        }
        // xóa
        $result = $this->bill->delete("id = :id", ['id' => $bill_id]);
        if ($result > 0) {
            $_SESSION['error'] = 'Hóa đơn đã được hủy thành công.';
        } else {
            $_SESSION['error'] = 'Đã có lỗi.';
        }
        header("Location: " . BASE_URL . "?act=goToBill");
        exit();
    }
}
