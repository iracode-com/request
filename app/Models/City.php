<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $table    = 'cities';
    protected $fillable = ['province_id', 'name', 'name_en', 'latitude', 'longitude', 'status'];
    protected $casts    = ['status' => Status::class];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
