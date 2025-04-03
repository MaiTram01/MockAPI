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
        $products = Http::get($this->apiUrl)->json()['data'];
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $total = count($products);
        $lastPage = ceil($total / $perPage);
        $products = array_slice($products, ($currentPage - 1) * $perPage, $perPage);
        $pageRange = range(1, $lastPage);
        return view('products.index', compact('products', 'currentPage', 'lastPage', 'pageRange', 'total', 'perPage'));
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
            "description" => $data['description'] ?? null,
            "unitPrice" => (float) $data['unitPrice'],
            "promotionPrice" => (float) ($data['promotionPrice'] ?? 0),
            "image" => $data['image'] ?? "",
            "unit" => $data['unit'] ?? "cái",
            "new" => (bool) $data['new'] ?? 0
        ];

        $response = $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            // Chỉ định rằng body dữ liệu gửi đi là JSON
        ])->post($this->apiUrl, $formattedData);

        if ($response->status() == 201) {
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo!');
        }
        dd($response->status());
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
            "unitPrice" => (float) $data['unitPrice'],
            "promotionPrice" => (float) ($data['promotionPrice'] ?? 0),
            "image" => $data['image'] ?? "",
            "unit" => $data['unit'] ?? "cái",
            "new" => (bool) $data['new'] ?? 0
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->put("{$this->apiUrl}/$id", $formattedData);

        if ($response->status() == 200) {
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật!');
            // dd($response->status(), $response->body(), $formattedData);

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
