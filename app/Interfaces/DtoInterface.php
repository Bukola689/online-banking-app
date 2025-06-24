<?php

namespace App\Interfaces;

interface DtoInterface
{

    public static function fromApiFormRequest():self;

    public static function fromModel(Model $model): self;

    public static function toArray(Model $model): self;
}