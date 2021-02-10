<?php

declare(strict_types=1);


namespace Nashgao\Mongo\QueryBuilder\Aspect;

use Nashgao\Mongo\QueryBuilder\Annotation\InsertResultAnnotation;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;
use Hyperf\GoTask\MongoClient\Type\InsertManyResult;
use Hyperf\GoTask\MongoClient\Type\InsertOneResult;

/**
 * @Aspect
 */
class InsertResultAspect extends AbstractAspect
{
    public $annotations = [
        InsertResultAnnotation::class
    ];

    /**
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return mixed
     * @throws Exception
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        /** @var InsertOneResult|InsertManyResult $result */
        $result = $proceedingJoinPoint->process();

        return (isset($result)) ?
            ($result->getInsertedId() or $result->getInsertedIDs())  // since count returns int, convert that into boolean
            : false;
    }
}
