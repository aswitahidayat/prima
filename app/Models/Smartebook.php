<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmartEbook extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['nama', 'keterangan', 'jenjang1', 'jenjang2', 'kurikulum'];
}
