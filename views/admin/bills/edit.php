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
        $status="selected";
        ?>
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($_SESSION['error'] as $err):  ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['error']) ?>
        <?php endif; ?>

        <form class="border p-4" action="<?= BASE_URL_ADMIN . '&act=bills-update&id=' . $bill['id']?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3 mt-3">
                        <label for="bill_status" class="form-label">Trạng thái đơn hàng</label>
                        <select class="form-control" name="bill_status">
                            <option value="" disabled>Chọn trạng thái đơn hàng</option>
                            <option value="$bill['bill_status']" selected disabled <?=$status?>>
                                <?php
                                if($bill['bill_status']==1) {echo "Pending";}
                                else if($bill['bill_status']==2) {echo "Processing";}
                                else if($bill['bill_status']==3) {echo "Shipping";}
                                else if($bill['bill_status']==4) {echo "Delivered";}
                                else if($bill['bill_status']==5) {echo "Canceled";}
                                ?>
                            </option>
                            <option value="1">Pending</option>
                            <option value="2">Processing</option>
                            <option value="3">Shipping</option>
                            <option value="4">Delivered</option>
                            <option value="5">Canceled</option>
                        </select>
                    </div>
                </div>
            </div>
            <a class="btn btn-dark" href="<?= BASE_URL_ADMIN ?>&act=bills-index">Quay lại trang danh sách</a>
            <button class="btn btn-success " type="submit">Update</button> 
        </form>
        <?php unset($_SESSION['data']) ?>
    </div>
    </div>
    </div>
</main>