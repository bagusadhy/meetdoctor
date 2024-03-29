<?php

namespace App\Models;

use App\Models\ManagementAccess\DetailUser;
use App\Models\ManagementAccess\Role;
use App\Models\ManagementAccess\RoleUser;
use App\Models\Operational\Appointment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    // use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    use SoftDeletes;


    protected $dates = [
        'update_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    public function appointment()
    {
        // 2 parameter(model tujuan, foreign key)
        return $this->hasMany(Appointment::class, 'user_id');
    }

    public function detail_user()
    {
        // 2 parameter(model tujuan, foreign key)
        return $this->hasOne(DetailUser::class, 'user_id');
    }

    public function role_user()
    {
        // 2 parameter(model tujuan, foreign key)
        return $this->hasMany(RoleUser::class, 'user_id');
    }

    public function doctor()
    {
        // 2 parameters (model yang tujuan, foreign key)
        return $this->hasOne(Doctor::class, 'user_id');
    }
}
