<?php

namespace App\Repositories\Dev;


use App\Models\Dev\Query;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\BaseRepositoryInterface;

/**
 * Created by PhpStorm
 * Author: wxyClark
 * Date: 2025/11/29
 * Time: 17:23
 * Email: C18666211369@outlook.com
 */
class QueryRepository extends BaseRepository implements BaseRepositoryInterface
{

    protected $inTermFields = [
        'id', 'query_code', 'user_id '
    ];
    protected $timeRangeFields = [
        'created_at', 'updated_at'
    ];
    protected $numberRangeFields = [
        'exec_time',
    ];

    protected function model(): string
    {
        return Query::class;
    }
}
