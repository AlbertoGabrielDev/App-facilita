<?php

namespace App\Traits;

use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\UserController;
use App\Models\Livro;
use App\Models\LivroEmprestimo;
use App\Models\User;

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

    protected function getCombinedFieldSearchable()
 {

     $combinedFieldSearchable = $this->prepareFieldSearchable($this->fieldSearchable, $this->model());

     $emprestimo = app(EmprestimoController::class);
     $livro = app(LivroController::class);
     $user = app(UserController::class);
     $combinedFieldSearchable = array_merge(
         $combinedFieldSearchable,
         $this->prepareFieldSearchable( $emprestimo->fieldSearchable, $emprestimo->model()),
         $this->prepareFieldSearchable( $livro->fieldSearchable, $livro->model()),
         $this->prepareFieldSearchable( $user->fieldSearchable, $user->model()),
     );
 
     return $combinedFieldSearchable;
 }

 protected function prepareFieldSearchable(array $fieldSearchable, string $model)
 {

     return array_map(function ($operator) use ($model) {
         return [
             'operator' => $operator,
             'model' => $model,
         ];

     }, $fieldSearchable);
 }

 protected function applyFilters()
 {
     $modelClass = $this->model();
     $query = $modelClass::query();
     $tableName = (new $modelClass)->getTable();
     $fieldSearchable = $this->getCombinedFieldSearchable();
     $filters = array_filter(request()->all(), function ($value) {
         return !is_null($value) && $value !== '';
     });
     $joinedTables = [];
     foreach ($filters as $field => $value) {

         if (!isset($fieldSearchable[$field])) {
       

             continue;
         }
        
         $operator = $fieldSearchable[$field]['operator'];
         $relatedModelClass = $fieldSearchable[$field]['model'];
         

         $relatedModelInstance = new $relatedModelClass;
         $relatedTable = $relatedModelInstance->getTable();
         $qualifiedField = "$relatedTable.$field";
         if ($relatedTable !== $tableName && !in_array($relatedTable, $joinedTables)) {
             $query->leftJoin(
                 $relatedTable,
                 "$relatedTable.id",
                 '=',
                 "$tableName.id_{$relatedTable}"
             );
             $joinedTables[] = $relatedTable;
         }
 
         // Ajusta o valor para LIKE
         if ($operator === 'like') {
             $value = '%' . $value . '%';
         }
 
         $query->where($qualifiedField, $operator, $value);
 
         \Log::info('Applying filter', [
             'field' => $qualifiedField,
             'operator' => $operator,
             'value' => $value,
         ]);
     }
 
     // Depuração da Query Completa
     $querySql = $query->toSql();
     $queryBindings = $query->getBindings();
 
     \Log::info('Query gerada:', [
         'sql' => $querySql,
         'bindings' => $queryBindings,
         'filters' => $filters,
     ]);
 
     return $query;
 }
}
