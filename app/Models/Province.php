<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;

    protected $table    = 'provinces';
    protected $fillable = ['name', 'name_en', 'latitude', 'longitude', 'status'];
    protected $casts    = ['status' => Status::class];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
