<?php

namespace App\Models;

use App\Models\Inbox;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disposition extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }

    public function userIdFrom() {
        return $this->belongsTo(User::class, 'user_id_from');
    }
    public function userIdTo() {
        return $this->belongsTo(User::class, 'user_id_to');
    }
}
