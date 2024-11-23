<script>
    const createVarian = () => {
        let count_items = document.querySelectorAll('.items-varian').length;
        const newVarian = document.getElementById('multi_varian');
        if (!newVarian) {
            console.error("Không tồn tại Id multi_varian");
            return;
        }

        const newElm = document.createElement('div');
        newElm.classList.add("items-varian", "border-top");
        newElm.innerHTML = `
        <div class="row p-2 mb-3">
            <div class="col-4">
                <label for="size-${count_items}" class="form-label">Dung lượng:</label>
                <input type="text" class="form-control" id="size-${count_items}" name="variants[${count_items}][size]">
            </div>
            <div class="col-4">
                <label for="color-${count_items}" class="form-label">Màu sắc:</label>
                <input type="text" class="form-control" id="color-${count_items}" name="variants[${count_items}][color]">
            </div>
            <div class="col-4">
                <label for="quantity-${count_items}" class="form-label">Số lượng:</label>
                <input type="number" class="form-control" id="quantity-${count_items}" name="variants[${count_items}][quantity]">
            </div>
        </div>
        <div class="row p-2 mb-3">
            <div class="col-6">
                <label for="price-varian-${count_items}" class="form-label">Giá:</label>
                <input type="text" class="form-control" id="price-varian-${count_items}" name="variants[${count_items}][price]">
            </div>
            <div class="col-6">
                <label for="price-sale-varian-${count_items}" class="form-label">Giá Sale:</label>
                <input type="text" class="form-control" id="price-sale-varian-${count_items}" name="variants[${count_items}][sale_price]">
            </div>
        </div>
        <div class="text-end mb-3">
            <button type="button" class="btn btn-outline-danger" onclick="removeVarian(this)">Xóa</button>
        </div>
    `;
        newVarian.append(newElm);

    };
    const removeVarian = (btn) => {
        console.log(btn);
        
        const parent = btn.closest('.items-varian');
        if (parent) {
            parent.remove();
        }
    };
</script>