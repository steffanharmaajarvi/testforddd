<?php

namespace App\Factories;

use App\Models\Feedback;
use http\Env\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class DBConnector implements iConnector
{

    protected $model;

    public function connect(string $model): iConnector
    {

        $this->model = new $model;

        return $this;

    }

    public function create(FormRequest $request): bool
    {

        $this->model->create($request->all());

        return true;

    }

    public function select(int $page, int $count): array
    {
        $skip = ($page - 1) * $count;

        $data = $this->model->skip($skip)->take($count)->get()->toArray();

        return $data;
    }
}
