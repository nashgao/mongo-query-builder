<?php

declare(strict_types=1);


namespace Nashgao\Mongo\QueryBuilder\Aspect;

use Nashgao\Mongo\QueryBuilder\Annotation\DeleteResultAnnotation;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Di\Exception\Exception;
use Hyperf\GoTask\MongoClient\Type\DeleteResult;

/**
 * @Aspect
 */
class DeleteResultAspect extends AbstractAspect
{
    public $annotations = [
        DeleteResultAnnotation::class
    ];

    /**
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return mixed
     * @throws Exception
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        /** @var DeleteResult $result */
        return ($proceedingJoinPoint->process()->getDeletedCount() == true);
    }
}
