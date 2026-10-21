<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'name_siswa',
        'nilai'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
