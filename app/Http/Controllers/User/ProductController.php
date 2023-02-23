<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $productService;
    protected $productVariantService;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        ProductService $productService,
        ProductVariantService $productVariantService
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
    }

    public function index(Request $request)
    {
        $products = $this->productRepository->getProductsPaginate($request, 24);
        return view('user.products.list.index', compact('products'));
    }

    public function getItemBySlug($slug)
    {
        if (Str::contains($slug, '-cat')) {
            $category = $this->categoryRepository->getCategoryBySlug($slug);
            $products = $category->products()->orderBy('id', 'DESC')->paginate(24);
            return view('user.products.list.index', compact('category', 'products', 'slug'));
        }
        if (Str::contains($slug, '-prod')) {
            $products = $this->productService->getProductInterested($limit = 4);
            $response = $this->productService->handleProductBySlug($slug);
            return view('user.products.detail.index', [
                'product' => $response['product'],
                'minPrice' => $response['minPrice'],
                'maxPrice' => $response['maxPrice'],
                'totalAmountProduct' => $response['totalAmountProduct'],
                'productAttributes' => $response['productAttributes'],
                'attrValues' => $response['attrValues'],
                'products' => $products
            ]);
        }
    }

    public function getFilterProduct(Request $request)
    {
        $products = $this->productRepository->getProductsFilterPaginate($request, 24);
        if (empty($products)) {
            $products = $this->productRepository->getProductsPaginate($request, 24);
            return view('user.products.list.index', compact('products'));
        }
        return view('user.products.list.index', compact('products'));
    }

    public function getVariantPrice(Request $request)
    {
        $response = $this->productVariantService->handleVariantPrice($request->all());
        return response()->json($response);
    }
}
