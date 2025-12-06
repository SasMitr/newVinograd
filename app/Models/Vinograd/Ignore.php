<?php

namespace App\Models\Vinograd;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Ignore extends Model
{
    protected $table = 'vinograd_ignores';
    public $timestamps = false;
    protected $fillable = ['phone', 'email', 'note'];

    public static function add($fields)
    {
        $ignor = new static;
        $ignor->phone = ignorPhone($fields->phone);
        $ignor->email = $fields->email;
        $ignor->note = $fields->note;
        $ignor->date_at = time();
        $ignor->save();

        return $ignor;
    }

    public function edit($fields)
    {
        $this->phone = ignorPhone($fields->phone);
        $this->email = $fields->email;
        $this->note = $fields->note;
        $this->save();
    }

    public function toggleStatus()
    {
        $this->is_blocked = !$this->is_blocked;
        $this->save();
    }

    public static function isIgnore($email, $phone)
    {
        return self::query()
            ->when($email, function (Builder $query, string $email) {
                $query->orWhere('email', $email);
            })
            ->when($phone, function (Builder $query, int $phone) {
                $query->orWhere('phone', $phone);
            })
            ->exists();
        //return self::query()->where('email', $email)->orWhere('phone', $phone)->exists();
    }
}
