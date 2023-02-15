<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class BaseRepository
 * @package App\Repositories\Base
 */
class BaseRepository implements BaseRepositoryInterface
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function createOrUpdate($findBy, $attributes, $forceCreate = false)
    {
        try {
            if ($forceCreate) {
                return $this->model::create($attributes);
            }
            return $this->model::updateOrCreate(
                [$findBy => $attributes[$findBy]],
                $attributes
            );
        } catch (QueryException $exception) {
            return $exception->errorInfo;
        }
    }

    public function getData($request, array $with = [])
    {
        $data = $this->model->with($with);

        $perPage = 10;

        if ($request->filled('per_page')) {
            $perPage = $request->per_page;
        }

        return response($data->paginate($perPage), 200);
    }
}
