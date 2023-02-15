<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories\Base
 */
interface BaseRepositoryInterface
{

    /**
     * @param $request
     * @param array $with
     *
     * @return mixed
     */
    public function createOrUpdate($findBy, $attributes );


}
