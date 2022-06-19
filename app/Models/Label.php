<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Label extends Model
{
    use HasFactory, Searchable;

    public $fillable = [
        'barcode_id',
        'package_status_id',
        'carrier_user_id',

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

    public function packageStatus()
    {
        return $this->belongsTo(PackageStatus::class);
    }

    public function carrier()
    {
        return $this->belongsTo(User::class, 'carrier_user_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_user_id');
    }

    public function toSearchableArray()
    {
        return [
            'barcode_id' => $this->barcode_id,
            'package_status_id' => $this->package_status_id,
            'carrier_name' => $this->carrier->name,
            'sender_name' => $this->sender->name,
            'receiver_name' => $this->receiver->name,
            'receiver_email' => $this->receiver->email,
        ];
    }

    public static function generateLabelCode(): string
    {
        return Str::random(28);
    }
}
