<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservations';
    protected $guard = [];

    public function rooms() :BelongsToMany
    {
        return $this->belongsToMany(Room::class)->withPivot("reservation_id", "room_id");
    }
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}