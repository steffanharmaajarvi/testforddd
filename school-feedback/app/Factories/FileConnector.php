<?php

namespace App\Factories;

use App\Models\Feedback;
use http\Env\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;


class FileConnector implements iConnector
{

    protected $filename;

    public function connect(string $model): iConnector
    {

        if ( !Storage::exists($model.'.txt') ) {
            Storage::put($model.'.txt', '');
        }

        $this->filename = $model . '.txt';

        return $this;

    }

    public function create(FormRequest $request): bool
    {

        $output = Storage::get($this->filename) . "\n";

        foreach ( $request->all() as $key => $line ) {
            if ( $key == 'source' ) continue;
            $output .= $key . ': ' . $line . ',';
        }

        $output .= "\n";

        Storage::put($this->filename, $output);

        return true;

    }

    public function select(int $page, int $count): array
    {
        $arr = explode("\n", Storage::get($this->filename));

        return $arr;
    }

}
