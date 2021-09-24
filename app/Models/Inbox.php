<?php

namespace App\Models;

use App\Models\Disposition;
use App\Models\JenisSurat;
use App\Models\Lampiran;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'perihal',
        'tipe_surat',
        'catatan',
        'tanggal_masuk',
        'jenis_surat_id',
        'edit_status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function lampiran()
    {
        return $this->hasMany(Lampiran::class);
    }

    public function disposition()
    {
        return $this->hasMany(Disposition::class);
    }

}
