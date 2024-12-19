<?php

namespace App\Traits;

trait FilterTrait
{
    protected function applyLikeConditions($query, $searchLike)
    {
        if ($searchLike) {
            foreach ($this->fieldSearchable as $field => $operator) {
                if ($operator === 'like') {
                    $query->orWhere($field, 'LIKE', '%' . $searchLike . '%');
                }

                if ($operator === '=') {
                    $query->orWhere($field, '=', $searchLike);
                }
            }
        }
    }
}
