<div class="container mt-5">
    <h2>Thêm sản phẩm</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Tên sản phẩm" required class="form-control mb-3">
        <textarea name="description" placeholder="Mô tả" class="form-control mb-3"></textarea>
        <input type="number" name="unitPrice" placeholder="Giá" required class="form-control mb-3"> 
        <input type="number" name="promotionPrice" placeholder="Giá khuyến mãi" class="form-control mb-3">
        <input type="text" name="image" placeholder="Link hình ảnh" class="form-control mb-3">
        <input type="text" name="unit" placeholder="Đơn vị" class="form-control mb-3">
        <select name="new" class="form-control mb-3">
            <option value="0">Cũ</option>
            <option value="1">Mới</option>
        </select>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
