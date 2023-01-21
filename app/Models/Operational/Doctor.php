<?php

namespace App\Models\Operational;

use App\Models\MasterData\Specialist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table name
    public $table = 'doctor';


    // this filed must type date with format yyyy-mm-dd hh:mm:ss
    protected $date = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare field that fillable
    protected $fillable = [
        'user_id',
        'specialist_id',
        'name',
        'fee',
        'photo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function specialist()
    {
        // 3 parameter (model tujuan, foreign key, primary key dari model tujuan)
        return $this->belongsTo(Specialist::class, 'specialist_id', 'id');
    }

    public function user()
    {
        // 3 parameter (model tujuan, foreign key, primary key dari model tujuan)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function appointment()
    {
        // 2 parameter (model tujuan, foreign key)
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
}
