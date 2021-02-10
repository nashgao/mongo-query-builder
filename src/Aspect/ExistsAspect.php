<?php

declare(strict_types=1);


namespace Nashgao\Mongo\QueryBuilder\Aspect;

use Nashgao\Mongo\QueryBuilder\Annotation\ExistsAnnotation;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;

/**
 * @Aspect
 */
class ExistsAspect extends AbstractAspect
{
    public $annotations = [
        ExistsAnnotation::class
    ];

    /**
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return mixed
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        try {
            /** @var array $result */
            $result = $proceedingJoinPoint->process();
        } catch (\Exception $exception) {
            return false;
        }

        // if there's no exceptions thrown, still need to check if's there's a valid result
        unset($result['_id']);
        // empty means doesn't exists, return false, not empty means exists, return true
        return !empty($result);
    }
}
