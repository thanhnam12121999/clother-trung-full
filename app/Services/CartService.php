<?php

namespace App\Services;

use App\Models\Member;
use App\Repositories\AttributeValueRepository;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartService extends BaseService
{
    protected $productRepository;
    protected $attributeValueRepository;
    protected $cartRepository;
    protected $productVariantRepository;

    public function __construct(
        ProductRepository $productRepository,
        AttributeValueRepository $attributeValueRepository,
        CartRepository $cartRepository,
        ProductVariantRepository $productVariantRepository
    ) {
        $this->productRepository = $productRepository;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->cartRepository = $cartRepository;
        $this->productVariantRepository = $productVariantRepository;
    }

    public function addCart($slug, array $data)
    {
        try {
            $product = $this->productRepository->getProductBySlug($slug);
            $attributes = $this->attributeValueRepository->getAttributeValuesOfProduct($data['attributes']);
            $attributes = $attributes->mapWithKeys(function ($attrValue) {
                return [$attrValue->attribute->name => $attrValue->name];
            })->all();
            $price = (int)str_replace(".","",$data['variant_price']);
            $cartItemData = [
                'id' => $slug . '-' . $data['variant_id'],
                'name' => $product->name,
                'qty' => $data['quantity'],
                'price' => $price,
                'weight' => 0,
                'options' => [
                    'product_id' => $product->id,
                    'attributes' => $attributes,
                    'slug' => $slug,
                    'variant_id' => $data['variant_id']
                ]
            ];
            if (isMemberLogged()) {
                $cartInstance = $this->cartRepository->getCartByMember(getAccountInfo()->id);
                Cart::destroy();
                Cart::add($cartItemData);
                Cart::setTax(Cart::content()->first()->rowId, 1);
                if (empty($cartInstance)) {
                    $subtotal = $data['quantity'] * $price;
                    $this->cartRepository->create([
                        'identifier' => getAccountInfo()->id,
                        'instance' => 'default',
                        'content' => Cart::content()->toJson(),
                        'sub_total' => $subtotal
                    ]);
                } else {
                    $cartItem = json_decode(json_encode(Cart::content()->first()), true);
                    $cartContent = getCart();
                    $isExistCartItem = array_key_exists($cartItem['rowId'], $cartContent);
                    if ($isExistCartItem) {
                        $cartContent[$cartItem['rowId']]['qty'] += $cartItem['qty'];
                    } else {
                        $cartContent[$cartItem['rowId']] = $cartItem;
                    }
                    $subtotal = $cartInstance->sub_total + $cartItem['qty'] * $cartItem['price'];
                    tap($cartInstance)->update([
                        'content' => json_encode($cartContent),
                        'sub_total' => $subtotal
                    ]);
                }
            } else {
                Cart::add($cartItemData);
                Cart::setTax(Cart::content()->first()->rowId, 1);
            }
            return $this->sendResponse('Đã thêm sản phẩm vào giỏ hàng');
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $this->sendError('Sản phẩm chưa được thêm vào giỏ hàng');
    }

    public function deleteCartItem($rowId)
    {
        try {
            DB::beginTransaction();
            if (isMemberLogged()) {
                $cartContent = getCart();
                $subtotalItem = $cartContent[$rowId]['qty'] * $cartContent[$rowId]['price'];
                unset($cartContent[$rowId]);
                $cartInstance = $this->cartRepository->getCartByMember(getAccountInfo()->id);
                $subtotal = $cartInstance->sub_total - $subtotalItem;
                tap($cartInstance)->update([
                    'content' => json_encode($cartContent),
                    'sub_total' => $subtotal
                ]);
            } else {
                Cart::remove($rowId);
            }
            DB::commit();
            return $this->sendResponse('Đã xóa sản phẩm khỏi giỏ hàng');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại');
    }

    public function updateCart($quantity)
    {
        try {
            DB::beginTransaction();
            $cartContent = getCart();
            if (isMemberLogged()) {
                foreach ($quantity as $rowId => $qtyItem) {
                    $variantAmount = $this->productVariantRepository
                        ->getVariantAmountByVariantId($cartContent[$rowId]['options']['variant_id']);
                    if ($qtyItem > $variantAmount) {
                        return $this->sendError(
                            'Số lượng thêm giỏ hàng đã vượt quá số lượng trong kho',
                            Response::HTTP_BAD_REQUEST
                        );
                    }
                    $cartContent[$rowId]['qty'] = $qtyItem;
                }
                $cartInstance = $this->cartRepository->getCartByMember(getAccountInfo()->id);
                $subtotal = collect($cartContent)->reduce(function ($carry, $cartItem) {
                    return $carry + $cartItem['qty'] * $cartItem['price'];
                }, 0);
                tap($cartInstance)->update([
                    'content' => json_encode($cartContent),
                    'sub_total' => $subtotal
                ]);
            } else {
                foreach ($quantity as $rowId => $qtyItem) {
                    $variantAmount = $this->productVariantRepository
                        ->getVariantAmountByVariantId($cartContent[$rowId]['options']['variant_id']);
                    if ($qtyItem > $variantAmount) {
                        return $this->sendError(
                            'Số lượng thêm giỏ hàng đã vượt quá số lượng trong kho',
                            Response::HTTP_BAD_REQUEST
                        );
                    }
                    Cart::update($rowId, $qtyItem);
                }
            }
            DB::commit();
            return $this->sendResponse('Cập nhật giỏ hàng thành công');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại');
    }
}
