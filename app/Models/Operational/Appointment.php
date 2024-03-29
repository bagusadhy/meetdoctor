<?php

namespace App\Models\Operational;

use App\Models\MasterData\Consultation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table name
    public $table = 'appointment';


    // this filed must type date with format yyyy-mm-dd hh:mm:ss
    protected $date = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare field that fillable
    protected $fillable = [
        'doctor_id',
        'user_id',
        'consultation_id',
        'level',
        'date',
        'time',
        'payment_status',
        'midtrans_url',
        'midtrans_booking_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function doctor()
    {
        // 3 parameter(model tujuan, foreign key, primary key dari model tujuan)
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function consultation()
    {
        // 3 parameter(model tujuan, foreign key, primary ke di model tujuan)
        return $this->belongsTo(Consultation::class, 'consultation_id', 'id');
    }

    public function user()
    {
        // 3 parameter(model tujuan, foreign key, primary ke di model tujuan)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function transaction()
    {
        // 2 parameter(model tujuan, foreign key)
        return $this->hasOne(Transaction::class, 'appointment_id');
    }
}
