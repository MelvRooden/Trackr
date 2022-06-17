<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Label extends Model
{
    use HasFactory;

    public $fillable = [
        'barcode_id',
        'package_status',
        'carrier_company',

        'sender_user_id',
        'sender_address',
        'sender_postcode',
        'sender_city',

        'receiver_user_id',
        'receiver_address',
        'receiver_postcode',
        'receiver_city'
    ];


    protected $guarded = ['íd'];

    public function packageStatus(): BelongsTo
    {
        return $this->BelongsTo(PackageStatus::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


    public static function generateLabelCode(): string
    {
        return Str::random(28);
    }
}
