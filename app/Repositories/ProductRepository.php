<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return Product::class;
    }

    public function getAllPorudctAndLoadCate()
    {
        return $this->model->with('category')->get();
    }

    public function getProductFeature($limit)
    {
        return $this->model->latest()->take($limit)->get();
    }

    public function getProductInterested($limit)
    {
        return $this->model->inRandomOrder()->limit($limit)->get();
    }

    public function getById($id)
    {
        return $this->model->with('variants')->find($id);
    }

    public function deleteImagesRelation($product)
    {
        foreach ($product->images as $image) {
            $image->delete();
        }
    }

    public function getProductsPaginate(Request $request, $perPage = 10)
    {
        $query = $this->model->orderBy('id', 'DESC')->paginate($perPage);
        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query = $this->model->where('name', 'like', "%{$keyword}%")
                ->orWhere('slug', 'like', "%{$keyword}%")
                ->orWhere('summary', 'like', "%{$keyword}%")
                ->orWhere('detail', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%")
                ->orWhereHas('attributes', function (Builder $q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                })
                ->orWhereHas('category', function (Builder $q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                        ->orWhere('slug', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%");
                })
                ->orderBy('id', 'DESC')
                ->paginate($perPage);
        }
        return $query;
    }

    public function getProductBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function createMutilImage()
    {
        return ;
    }

    public function getProductsFilterPaginate($request, $perPage = 10)
    {
        $query = $this->model;
        if ($request->has('minamount') && $request->has('maxamount')) {
            $minAmount = (int) str_replace('$', '', $request->get('minamount'));
            $maxAmount = (int) str_replace('$', '', $request->get('maxamount'));
            $query = $query->whereHas('variants', function ($query) use ($minAmount, $maxAmount) {
                $query->whereBetween('unit_price', [$minAmount, $maxAmount]);
            });
        }
        if ($request->has('size')) {
            $size = $request->get('size');
            $query = $query->whereHas('attributes', function ($query) use ($size) {
                $query->where('attribute_value_id', $size);
            });
        }
        if ($request->has('color')) {
            $color = $request->get('color');
            $query = $query->whereHas('attributes', function ($query) use ($color) {
                $query->where('attribute_value_id', $color);
            });
        }
        return $query->paginate($perPage);
    }
}
