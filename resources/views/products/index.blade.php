<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Danh sách sản phẩm</h2>
        
        <!-- Thêm sản phẩm -->
        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Thêm sản phẩm</a>

        <!-- Thông báo thành công -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bảng danh sách sản phẩm -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Giá khuyến mãi</th>
                    <th>Hình ảnh</th>
                    <th>Đơn vị</th>
                    <th>Mới</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product['product_id'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['description'] }}</td>
                    <td>{{ number_format($product['unitPrice'], 0, ',', '.') }}đ</td>
                    <td>{{ $product['promotionPrice'] ? number_format($product['promotionPrice'], 0, ',', '.') . 'đ' : 'Không' }}</td>
                    <td><img src="{{ $product['image'] }}" alt="" style="width:60px; height: 50px"></td>
                    <td>{{ $product['unit'] }}</td>
                    <td>{{ $product['new'] ? 'Có' : 'Không' }}</td>
                    <td>
                        <!-- Sửa sản phẩm -->
                        <a href="{{ route('products.edit', $product['product_id']) }}" class="btn btn-warning btn-sm">Sửa</a>

                        <!-- Xóa sản phẩm -->
                        <form action="{{ route('products.destroy', $product['product_id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
