<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    use HasFactory;
    protected $table = "rooms";
    protected $fillable = ["name", "description", "hotel_id"];
    public function hotel() : BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
    public function type () : BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'room_type_id', 'id');
    }
    public function reservations () : BelongsToMany
    {
        return $this->belongsToMany(Reservation::class);
    }
}