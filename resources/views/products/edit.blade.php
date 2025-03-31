<div class="container mt-5">
    <h2>Chỉnh sửa sản phẩm</h2>
    <form action="{{ route('products.update', $product['product_id']) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $product['name'] }}" required class="form-control mb-3">
        <textarea name="description" class="form-control mb-3">{{ $product['description'] }}</textarea>
        <input type="number" name="unitPrice" value="{{ $product['unitPrice'] }}" required class="form-control mb-3">
        <input type="number" name="promotionPrice" value="{{ $product['promotionPrice'] }}" class="form-control mb-3">
        <input type="text" name="image" value="{{ $product['image'] }}" class="form-control mb-3">
        <input type="text" name="unit" value="{{ $product['unit'] }}" class="form-control mb-3">
        <select name="new" class="form-control mb-3">
            <option value="1" {{ $product['new'] == 1 ? 'selected' : '' }}>Mới</option>
            <option value="0" {{ $product['new'] == 0 ? 'selected' : '' }}>Cũ</option>
        </select>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>