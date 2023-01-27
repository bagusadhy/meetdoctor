<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{

    // use HasFactory;
    use SoftDeletes;

    // declare table name
    public $table = 'transaction';


    // this filed must type date with format yyyy-mm-dd hh:mm:ss
    protected $date = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare field that fillable
    protected $fillable = [
        'appointment_id',
        'fee_doctor',
        'fee_specialist',
        'fee_hospital',
        'sub_total',
        'vat',
        'total',
        'payment_status',
        'midtrans_url',
        'midtrans_booking_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function appointment()
    {
        // 3 parameter(model tujuan, foreign key, primary key di model tujuan)
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }
}
