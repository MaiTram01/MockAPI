<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    private $apiUrl = "https://product-api-02.onrender.com/api/v1/products";

    // Lấy danh sách sản phẩm
    public function index()
    {
        $response = Http::get($this->apiUrl);
        $data = $response->json();
        $products = $data['data'];

        return view('products.index', compact('products'));
    }

    // Hiển thị form tạo sản phẩm
    public function create()
    {
        return view('products.create');
    }

    // Lưu sản phẩm mới
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $formattedData = [
            "name" => $data['name'],
            "description" => $data['description'] ?? "",
            "unitPrice" => $data['unitPrice'],
            "promotionPrice" => $data['promotionPrice'] ?? null,
            "image" => $data['image'] ?? "",
            "unit" => $data['unit'] ?? "cái",
            "new" => $data['new'] ?? 0
        ];

        $response = Http::post($this->apiUrl, $formattedData);

        if ($response->successful()) {
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo!');
        }
        return back()->withErrors(['message' => 'Lỗi khi tạo sản phẩm!']);
    }


    // Hiển thị form chỉnh sửa sản phẩm
    public function edit($id)
    {
        $response = Http::get("{$this->apiUrl}/$id");
        if ($response->successful()) {
            $data = $response->json();
            $product = $data['data'];
            return view('products.edit', compact('product'));
        }
        return redirect()->route('products.index')->withErrors(['message' => 'Không tìm thấy sản phẩm!']);
    }

    // Cập nhật sản phẩm
    public function update(StoreProductRequest $request, $id)
    {
        $data = $request->validated();
        $formattedData = [
            "name" => $data['name'],
            "description" => $data['description'] ?? "",
            "unitPrice" => $data['unitPrice'],
            "promotionPrice" => $data['promotionPrice'] ?? null, 
            "image" => $data['image'] ?? "", 
            "unit" => $data['unit'] ?? "cái",
            "new" => $data['new'] ?? 0
        ];

        $response = Http::put("{$this->apiUrl}/$id", $formattedData);

        if ($response->successful()) {
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật!');
        }
        return back()->withErrors(['message' => 'Lỗi khi cập nhật sản phẩm!']);
    }


    // Xóa sản phẩm
    public function destroy($id)
    {
        $response = Http::delete("{$this->apiUrl}/$id");

        if ($response->successful()) {
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa!');
        }
        return back()->withErrors(['message' => 'Lỗi khi xóa sản phẩm!']);
    }
}
