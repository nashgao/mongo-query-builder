<?php

declare(strict_types=1);


namespace Nashgao\Mongo\QueryBuilder;

use Hyperf\GoTask\MongoClient\Type\DeleteResult;
use Hyperf\GoTask\MongoClient\Type\InsertManyResult;
use Hyperf\GoTask\MongoClient\Type\InsertOneResult;
use Hyperf\GoTask\MongoClient\Type\UpdateResult;
use Hyperf\GoTask\MongoClient\Collection;
use Nashgao\Mongo\QueryBuilder\Annotation\DeleteResultAnnotation;
use Nashgao\Mongo\QueryBuilder\Annotation\FindOneResultAnnotation;
use Nashgao\Mongo\QueryBuilder\Annotation\FindResultAnnotation;
use Nashgao\Mongo\QueryBuilder\Annotation\InsertResultAnnotation;
use Nashgao\Mongo\QueryBuilder\Annotation\UpdateResultAnnotation;

class MongoDao
{
    protected Mongo $model;

    protected Collection $collection;

    public function __construct(Mongo $model)
    {
        $this->model = $model;
        $this->collection = $this->model->{$this->model->getDatabaseName()}->{$this->model->getCollectionName()};
    }

    /**
     * @FindOneResultAnnotation
     * @param array $filters
     * @param array $options
     * @return array
     */
    public function findOne(array $filters, array $options = []): array
    {
        return $this->collection->findOne($filters, $options);
    }

    /**
     * @FindResultAnnotation
     * @param array $filters
     * @param array $options
     * @return array
     */
    public function findMany(array $filters, array $options = []): array
    {
        return $this->collection->find($filters, $options);
    }

    /**
     * @InsertResultAnnotation
     * @param array $documents
     * @param array $options
     * @return bool|InsertOneResult
     */
    public function insertOne(array $documents, array $options = [])
    {
        return $this->collection->insertOne($documents, $options);
    }

    /**
     * @InsertResultAnnotation
     * @param array $documents
     * @param array $options
     * @return bool|InsertManyResult
     */
    public function insertMany(array $documents, array $options = [])
    {
        return $this->collection->insertMany($documents, $options);
    }

    /**
     * @UpdateResultAnnotation
     * @param array $filter
     * @param array $update
     * @param array $options
     * @return bool|UpdateResult
     */
    public function updateOne(array $filter, array $update, array $options = [])
    {
        return $this->collection->updateOne($filter, $update, $options);
    }

    /**
     * @UpdateResultAnnotation
     * @param array $filter
     * @param array $update
     * @param array $options
     * @return bool|UpdateResult
     */
    public function updateMany(array $filter, array $update, array $options = [])
    {
        return $this->collection->updateMany($filter, $update, $options);
    }

    /**
     * @DeleteResultAnnotation
     * @param array $filter
     * @param array $options
     * @return bool|DeleteResult
     */
    public function deleteOne(array $filter, array $options = [])
    {
        return $this->collection->deleteOne($filter, $options);
    }

    /**
     * @DeleteResultAnnotation
     * @param array $filter
     * @param array $options
     * @return bool|DeleteResult
     */
    public function deleteMany(array $filter, array $options = [])
    {
        return $this->collection->deleteMany($filter, $options);
    }


    public function createCompoundIndex(array $columns): string
    {
        return $this->collection->createIndex($columns);
    }

    public function getModel(): Mongo
    {
        return $this->model;
    }
}
