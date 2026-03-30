<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
        protected $primaryKey = 'aten_id';
        public $incrementing = true;
        protected $keytype= "int";

        protected $fillable = ['user_id', 'in_time', 'out_time','status', 'total_duration'];
        protected $casts   = ['in_time' => 'datetime', 
                            'out_time' => 'datetime'];
        
        public function user() { return $this->belongsTo(User::class, 'user_id'); }

}
