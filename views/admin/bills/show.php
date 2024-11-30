<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?= $title ?></li>
        </ol>
        <?php
        if (isset($_SESSION['success'])) {
            $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';

            echo "<div class='alert $class'>{$_SESSION['msg']}</div>";

            unset($_SESSION['success']);
            unset($_SESSION['msg']);
        }
        ?>
        </table>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
            <a class="btn btn-success" href="<?= BASE_URL_ADMIN . '&act=bills-index'?>">Quay lại</a>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Dữ Liệu</th>
                            <th>Giá trị</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($data as $key => $value): ?>
                        <tr>
                            <td class="border">
                                <?php switch ($key) {
                                        case 'id':
                                            echo "ID hóa đơn";
                                            break;
                                        case 'create_at':
                                            echo "Thời gian đặt";
                                            break;
                                        case 'bill_status':
                                            echo "Trạng thái đơn";
                                            break;
                                        case 'payment_type':
                                            echo "Hình thức thanh toán";
                                            break;
                                        case 'user_id':
                                            echo "ID người mua";
                                            break;
                                        case 'user_name':
                                            echo "Tên người mua";
                                            break;
                                        case 'user_email':
                                            echo "Email";
                                            break;
                                        case 'user_address':
                                            echo "Địa chỉ giao hàng";
                                            break;
                                        case 'user_phone':
                                            echo "Điện thoại liên hệ";
                                            break;
                                        case 'total':
                                            echo "Tổng tiền";
                                            break;
                                        default:
                                            echo $key;
                                            break;
                                    } ?>
                            </td>
                            <td class="border">
                                <?php
                                    switch ($key) {
                                        case 'total':
                                            echo number_format($value, 0, ',', '.') . "đ";
                                            break;
                                        case 'bill_status':
                                            echo $statusLabels[$value];
                                            break;
                                        case 'payment_type':
                                            echo $paymentLabels[$value];
                                            break;
                                        default:
                                            echo $value;
                                            break;
                                    }
                                    ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <a class="btn btn-success" href="<?= BASE_URL_ADMIN . '&act=bills-index'?>">Quay lại</a>
            </div>
        </div>
    </div>
</main>