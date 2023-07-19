<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

abstract class AbstractFactory
{
    protected object $item;

    abstract public function create(mixed $data = null, mixed $id = null): mixed;

    public static function buildEnum($className, $data): mixed
    {
        $instance = $className::tryfrom($data);
        if ($instance instanceof $className) {
            return $instance;
        }

        return null;
    }

    public function executeFactories($dataFactory, $data)
    {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $dataFactory)) {
                $factoryKey = $dataFactory[$key];
                if (array_key_exists('listName', $factoryKey)) {
                    $array = [];
                    foreach ($value as $val) {
                        $array[] = $factoryKey['factory']->create($val);
                    }
                    $this->item->{$factoryKey['set']}(new $factoryKey['listName']($array));
                } else {
                    $factory = $factoryKey['factory']->create($value);
                    $this->item->{$factoryKey['set']}($factory);
                }
            }
        }
    }

    abstract protected function reset(mixed $data): void;
}
