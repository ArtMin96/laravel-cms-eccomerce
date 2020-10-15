<?php


namespace App\Filters;


class ProductFilters extends QueryFilter
{

    public function catalog($catalog = null)
    {
        return $this->builder->whereHas('catalog', function ($query) use ($catalog) {
            $query->where('id', $catalog);
        });
    }

    public function created($created_at = null)
    {
        if (!is_null($created_at)) {
            return $this->builder->whereDate('created_at', '=', $created_at);
        }
    }

    public function language($languageId = null)
    {
        if (!is_null($languageId)) {
            return $this->builder->where('language', '=', $languageId)->where('sale_type_id', '=', 1);
        }
    }

    public function title()
    {
        return $this->builder->whereHas('productTranslations', function ($q) {
            $q->orderBy('title');
        });
    }

    public function search($keyword)
    {
        return $this->builder->whereHas('productTranslations', function ($q) {
            $q->where('title', 'like', '%'.$q.'%');
        });
    }

    public function price($order = 'asc')
    {
        return $this->builder->orderBy('price', $order);
    }
}
