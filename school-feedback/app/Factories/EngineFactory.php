<?php

namespace App\Factories;

interface iFactory {

    public static function make(string $engineType): iConnector;

}

class EngineFactory implements iFactory
{

    public static function make (string $engineType): iConnector
    {
        $class = "\App\Factories\\" . $engineType . 'Connector';

        return new $class;

    }

}
