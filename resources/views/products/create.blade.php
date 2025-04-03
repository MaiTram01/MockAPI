<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #4CAF50;
        font-family: 'Arial', sans-serif;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    input[type="text"], input[type="number"], textarea, select {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
        outline: none;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus, input[type="number"]:focus, textarea:focus, select:focus {
        border-color: #4CAF50;
    }

    textarea {
        resize: vertical;
        height: 150px;
    }

    button {
        padding: 10px 20px;
        font-size: 16px;
        color: white;
        background-color: #4CAF50;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #45a049;
    }

    .form-control {
        box-sizing: border-box;
    }
</style>


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