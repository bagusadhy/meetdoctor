<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfigPayment extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table name
    public $table = 'config_payment';


    // this filed must type date with format yyyy-mm-dd hh:mm:ss
    protected $date = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare field that fillable
    protected $fillable = [
        'fee',
        'vat',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
