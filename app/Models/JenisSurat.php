<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;
    protected $fillable = ['jenis_surat_name'];

    public function surat()
    {
        return $this->hasMany(Inbox::class);
    }
}
