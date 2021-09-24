<?php

namespace App\Models;

use App\Models\Inbox;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;
    protected $fillable = ['inbox_id', 'lampiran_path'];

    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }
}
