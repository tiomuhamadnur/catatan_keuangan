<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Absorption extends Model
{
    use SoftDeletes;

    protected $table = 'absorption';

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->total = $model->price * $model->qty;
        });

        self::updating(function ($model) {
            $model->total = $model->price * $model->qty;
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
