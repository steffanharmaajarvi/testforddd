<?php

namespace App\Factories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

interface iConnector
{

    public function connect(string $model): self;

    public function create(FormRequest $request): bool;

    public function select(int $page, int $count): array;

}
