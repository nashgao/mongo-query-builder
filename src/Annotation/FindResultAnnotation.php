<?php
/**
 * Copyright (C) SPACE Platform PTY LTD - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by Nash Gao <nash@spaceplaform.co>
 * @organization Space Platform
 * @project space-webapp-server-hyperf
 * @create Created on 2020/9/11 上午3:07
 * @author Nash Gao
 */

declare(strict_types=1);


namespace App\Annotation\Mongodb\Result;

use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * @Annotation
 * @Target("METHOD")
 */
class FindResultAnnotation extends AbstractAnnotation
{

}