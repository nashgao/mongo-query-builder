<?php

declare(strict_types=1);


namespace Nashgao\Mongo\QueryBuilder;

use Hyperf\GoTask\MongoClient\Collection;
use Hyperf\GoTask\MongoClient\MongoClient;

class MongoModel extends MongoClient
{
    protected string $database;
    protected string $collection;
    protected string $primaryKey;

    public Collection $query;

    public function getDatabaseName(): string
    {
        return $this->database;
    }

    public function getCollectionName(): string
    {
        return $this->collection;
    }

    public function getPrimaryKeyName(): string
    {
        return $this->primaryKey;
    }
}
