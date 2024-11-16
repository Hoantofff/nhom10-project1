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

        <form class="border p-4" action="<?= BASE_URL_ADMIN . '&act=product-startCreate' ?>" method="POST"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên sản phẩm:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= $_SESSION['data']['name'] ?? null ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="category" class="form-label">Thể loại</label>
                        <select id="category" class="form-control" name="category_id">
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?= $category['id'] ?>">
                                    <?= $category['name'] ?></option>
                            <?php } ?>

                        </select>

                    </div>
                    <div class="mb-3 mt-3">
                        <label for="brand" class="form-label">Thương hiệu:</label>
                        <select id="brand" class="form-control" name="brand_id">
                            <?php foreach ($brands as $brand) { ?>
                                <option value="<?= $brand['id'] ?>">
                                    <?= $brand['name'] . "-" . $brand['category_name'] ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="price" class="form-label">Giá chưa giảm:</label>
                        <input type="text" class="form-control" id="price" name="price"
                            value="<?= $_SESSION['data']['price'] ?? null ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 mt-3">
                        <label for="sale_price" class="form-label">Giá đã giảm:</label>
                        <input type="sale_price" class="form-control" id="sale_price" name="sale_price"
                            value="<?= $_SESSION['data']['sale_price'] ?? null ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="discount" class="form-label">Phần trăm giảm giá:</label>
                        <input type="text" class="form-control" id="discount" name="discount"
                            value="<?= $_SESSION['data']['discount'] ?? null ?>">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="description">Mô tả của sản phẩm:</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                            value="<?= $_SESSION['data']['description'] ?? null ?>"></textarea>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="content">Giới thiệu của sản phẩm:</label>
                        <textarea class="form-control" id="content" name="content" rows="3"
                            value="<?= $_SESSION['data']['content'] ?? null ?>"></textarea>

                    </div>
                </div>


                <div class="mb-3">
                    <label for="image" class="form-label">Ảnh sản phẩm:</label>
                    <input type="file" class="form-control" id="image" name="image">

                    <?php if (!empty($user['u_image'])): ?>
                        <img src="<?= BASE_ASSETS_UPLOADS . $user['u_image'] ?>" width="100px">
                    <?php endif; ?>
                </div>
            </div>
            <a class="btn btn-dark" href="<?= BASE_URL_ADMIN ?>&act=products-index">Quay lại trang danh sách</a>
            <button class="btn btn-success " type="submit">Tạo Mới</button>

        </form>

        <?php unset($_SESSION['data']) ?>
    </div>
    </div>
    </div>
</main>