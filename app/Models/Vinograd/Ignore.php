<?php

namespace App\Models\Vinograd;

use Illuminate\Database\Eloquent\Model;

class Ignore extends Model
{
    protected $table = 'vinograd_ignores';
    public $timestamps = false;
    protected $fillable = ['phone', 'email', 'note'];

    public static function add($fields)
    {
        $ignor = new static;
        $ignor->fill($fields->all());
        $ignor->date_at = time();
        $ignor->save();

        return $ignor;
    }

    public function edit($fields)
    {
        $this->fill($fields->all());
        $this->save();
    }

    public function toggleStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }

    public function toggledsStatus()
    {
        $this->status = !$this->status;
        $this->save();
    }
}
