<?php

declare(strict_types=1);


namespace Nashgao\Mongo\QueryBuilder\Aspect;

use Nashgao\Mongo\QueryBuilder\Annotation\FindResultAnnotation;
use Nashgao\Mongo\QueryBuilder\Annotation\FindOneResultAnnotation;
use Hyperf\Di\Annotation\Aspect;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\Utils\Arr;

/**
 * @Aspect
 */
class FindResultAspect extends AbstractAspect
{
    public $annotations = [
        FindResultAnnotation::class,
        FindOneResultAnnotation::class
    ];

    /**
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return mixed
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint):array
    {
        /** @var array $result */
        try {
            $result = $proceedingJoinPoint->process();
        } catch (\Exception $exception) {
            var_dump($exception);
            return [];
        }

        if (Arr::first($proceedingJoinPoint->getAnnotationMetadata()->method) instanceof FindOneResultAnnotation) {
            unset($result['_id']);
        } else {
            unset($result[0]['_id']);
        }

        return $result;
    }
}
