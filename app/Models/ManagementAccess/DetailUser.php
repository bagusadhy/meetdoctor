<?php

namespace App\Models\ManagementAccess;

use App\Models\MasterData\TypeUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailUser extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table name
    public $table = 'detail_user';


    // this filed must type date with format yyyy-mm-dd hh:mm:ss
    protected $date = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare field that fillable
    protected $fillable = [
        'user_id',
        'type_user_id',
        'contact',
        'address',
        'photo',
        'gender',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function type_user()
    {
        // 3 parameter (model tujuan, foreign key, primary key dari model tujuan)
        return $this->belongsTo(TypeUser::class, 'type_user_id', 'id');
    }
    
    public function user()
    {
        // 3 parameter (model tujuan, foreign key, primary key dari model tujuan)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
