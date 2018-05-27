<?php

namespace App\Repositories\Eloquent;

use App\Models\Report;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\ReportRepositoryInterface;

class ReportRepository extends BaseRepository implements ReportRepositoryInterface
{
    public function getModel()
    {
        return Report::class;
    }
}
