<?php

namespace App\Repositories;

use App\Models\AttributeValue;

class AttributeValueRepository extends BaseRepository
{
    public function model()
    {
        return AttributeValue::class;
    }

    public function getAttributeValues()
    {
        return $this->model->orderBy('attribute_id', 'ASC')->get();
    }

    public function getAttributeValuesOfProduct($productAttributes)
    {
        return $this->model->whereIn('id', $productAttributes)->get();
    }

    public function getAllAttributeValueSize()
    {
        return $this->model->where('attribute_id', AttributeValue::ATTRIBUTE_SIZE)->get();
    }

    public function getAllAttributeValueColor()
    {
        return $this->model->where('attribute_id', AttributeValue::ATTRIBUTE_COLOR)->get();
    }
}
