<?php

namespace App\Factories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

interface iFactory
{


    public function create(FormRequest $request): bool;

    public function select(int $page, int $count): array;

}
