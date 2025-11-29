<?php

namespace App\Services\Dev;


use App\Repositories\Dev\QueryRepository;

/**
 * Created by PhpStorm
 * Author: wxyClark
 * Date: 2025/11/29
 * Time: 16:21
 * Email: C18666211369@outlook.com
 */
class QueryService
{

    /** @var QueryRepository */
    protected $queryRepository;

    public function __construct(
        QueryRepository $queryRepository
    ) {
        $this->queryRepository = $queryRepository;
    }
}
