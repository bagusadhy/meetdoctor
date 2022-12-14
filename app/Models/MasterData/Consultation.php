<?php

namespace App\Models\MasterData;

use App\Models\Operational\Appointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table name
    public $table = 'consultation';


    // this filed must type date with format yyyy-mm-dd hh:mm:ss
    protected $date = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare field that fillable
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function appointment()
    {
        // 2 parameter (model tujuan, foreign key)
        return $this->hasMany(Appointment::class, 'consultation_id');
    }
}
