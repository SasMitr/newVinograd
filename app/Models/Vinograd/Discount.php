<?php

namespace App\Models\Vinograd;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'vinograd_discount';
    public $timestamps = false;

    public function scopeActive($query)
    {
        return $query->where('status', 1);

    }

    public function activate(): void
    {
        $this->active = !$this->active;
    }
}
