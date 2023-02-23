<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCartRequest;
use App\Models\Member;
use App\Repositories\ProductRepository;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $productRepository;
    protected $cartService;

    public function __construct(ProductRepository $productRepository, CartService $cartService)
    {
        $this->productRepository = $productRepository;
        $this->cartService = $cartService;
    }

    public function index()
    {
        return view('user.cart.index');
    }

    public function add($slug, AddCartRequest $request)
    {
        if (!empty($request->errors)) {
            if (array_key_exists('quantity', $request->errors->messages())
                && !array_key_exists('variant_amount', $request->errors->messages())
            ) {
                $errorQuantity = $request->errors->messages()['quantity'][0];
                toast($errorQuantity, 'error')->autoClose(3000);
                return redirect()->back();
            }
            toast('Lỗi chọn thuộc tính sản phẩm hoặc sản phẩm đã hết', 'error')->autoClose(3000);
            return redirect()->back();
        }
        $response = $this->cartService->addCart($slug, $request->validated());
        if ($response['success']) {
            toast($response['message'], 'success')->autoClose(3000);
            return redirect()->back();
        }
        toast($response['message'], 'error')->autoClose(3000);
        return redirect()->back();
    }

    public function remove($rowId)
    {
        $response = $this->cartService->deleteCartItem($rowId);
        if ($response['success']) {
            toast($response['message'], 'success')->autoClose(3000);
            return redirect()->back();
        }
        toast($response['message'], 'error')->autoClose(3000);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if (!$request->has('quantity')) {
            toast('Cập nhật giỏ hàng thất bại', 'error')->autoClose(3000);
            return redirect()->back();
        }
        $response = $this->cartService->updateCart($request->get('quantity'));
        if ($response['success']) {
            toast($response['message'], 'success')->autoClose(3000);
            return redirect()->back();
        }
        toast($response['message'], 'error')->autoClose(3000);
        return redirect()->back();
    }
}
