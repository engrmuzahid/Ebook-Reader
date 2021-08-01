<?php

namespace Modules\Base\Search;

use Laravel\Scout\Builder;
use Laravel\Scout\Engines\Engine;
use Illuminate\Support\Facades\DB;

class MySqlSearchEngine extends Engine
{
    public function update($models)
    {
        //
    }

    public function delete($models)
    {
        //
    }

    /**
     * Pluck and return the primary keys of the given results.
     *
     * @param mixed $results
     * @return \Illuminate\Support\Collection
     */
    public function mapIds($results)
    {
        return $results['results'];
    }

    /**
     * Perform the given search on the engine.
     *
     * @param \Laravel\Scout\Builder $builder
     * @return mixed
     */
    public function search(Builder $builder)
    {
        $result = [];

        $query = DB::table($builder->model->searchTable());
        
        $columns = implode(',', $builder->model->searchColumns());

        $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->getSearchKeyword($builder));

        if ($builder->callback) {
            $query = call_user_func($builder->callback, $query, $this);
        }

        $result['count'] = $query->count();

        if (property_exists($builder, 'orders') && ! empty($builder->orders)) {
            foreach ($builder->orders as $order) {
                $query->orderBy($order['column'], $order['direction']);
            }
        }

        if ($builder->limit) {
            $query = $query->take($builder->limit);
        }

        if (property_exists($builder, 'offset') && $builder->offset) {
            $query = $query->skip($builder->offset);
        }

        $result['results'] = $query->pluck($builder->model->searchKey());

        return $result;
    }

    /**
     * Get the search query.
     *
     * @param \Laravel\Scout\Builder $builder
     * @return string
     */
    private function getSearchKeyword($builder)
    {
        if (is_null($builder->query)) {
            return '';
        }
        
        $query=preg_replace('/[-+~*()><@%"]/', ' ', $builder->query);
        if(trim($query)=="")
        {
            return '';
        }
        
        return '*' . $query . '*';
    }

    /**
     * Perform the given search on the engine.
     *
     * @param \Modules\Base\Search\Builder $builder
     * @param int $perPage
     * @param int $page
     * @return mixed
     */
    public function paginate(Builder $builder, $perPage, $page)
    {
        $builder->limit = $perPage;
        $builder->offset = ($perPage * $page) - $perPage;

        return $this->search($builder);
    }

    /**
     * Map the given results to instances of the given model.
     *
     * @param Laravel\Scout\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return \Illuminate\Support\Collection
     */
    public function map(Builder $builder, $results, $model)
    {
        return $results['results'];
    }

    /**
     * Get the total count from a raw result returned by the engine.
     *
     * @param mixed $results
     * @return int
     */
    public function getTotalCount($results)
    {
        return $results['count'];
    }
    
    public function flush($model){}
}
