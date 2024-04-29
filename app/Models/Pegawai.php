<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'user_data';

    protected $primaryKey = 'kd_user';

    protected $fillable = [
        'kd_user',
        'nm_user',
        'nip',
        'pangkat',
        'golongan',
        'jabatan',
        'tlp_user',
        'email_user',
        'kd_jab'
    ];

    public $incrementing = false;

    public $timestamps = false;

    public function getUserByKdJab($kd_jab)
    {
        $model = $this->where(['kd_jab' => $kd_jab])->get();

        return $model;
    }
}
