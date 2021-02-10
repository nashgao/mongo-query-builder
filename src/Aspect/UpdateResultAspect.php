<?php

declare(strict_types=1);


namespace Nashgao\Mongo\QueryBuilder\Aspect;

use Nashgao\Mongo\QueryBuilder\Annotation\UpdateResultAnnotation;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;
use Hyperf\GoTask\MongoClient\Type\UpdateResult;

/**
 * @Aspect
 */
class UpdateResultAspect extends AbstractAspect
{
    public $annotations = [
        UpdateResultAnnotation::class
    ];

    /**
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return bool
     * @throws Exception
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint):bool
    {
        /** @var UpdateResult $result */
        $result = $proceedingJoinPoint->process();
        return (isset($result)) ?
            ($result->getUpsertedCount() or $result->getModifiedCount())  // since count returns int, convert that into boolean
            : false;
    }
}
