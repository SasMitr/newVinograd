<?php

namespace App\Models\Vinograd\QueryBuilder;

use App\Status\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderQueryBuilder extends Builder
{

    public function getAllUserOrders($user_id) :LengthAwarePaginator
    {
        return $this->where('user_id', $user_id)
            ->orderBy('current_status')
            ->paginate(30);
    }

    public function timeRange($dateRange, $status) :OrderQueryBuilder
    {
        $data = !isset($status) ? 'completed_at' : 'created_at';

        $this->where($data, '>=', $dateRange['from']);
        $this->when($dateRange['to'], function (Builder $query) use ($data, $dateRange) {
            $query->where($data, '<=', $dateRange['to']);
        });
        return $this;
    }

    public function whereStatus($status) :OrderQueryBuilder
    {
        if (is_array($status)) {
            return $this->whereIn('current_status', $status);
        }
        return $status
            ? $this->where('current_status', $status)
            : $this->where('current_status', Status::COMPLETED);
    }

    public function whereNotInStatus() :OrderQueryBuilder
    {
        return $this->whereNotIn('current_status', [Status::CANCELLED, Status::CANCELLED_BY_CUSTOMER]);
    }
}
