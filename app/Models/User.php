<?php

namespace App\Models;

use App\Models\User\Address;
use App\Models\User\Profile;
use App\Models\User\Sns;
use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use AdminBuilder;

    //use Faker;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','confirmation_token','avatar','is_active'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function sns()
    {
        return $this->hasOne(Sns::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->withPivot('remark');
    }

    /**
     * @param $query
     * @param $gender
     * @return mixed
     */
    public function scopeGender($query, $gender)
    {
        if (!in_array($gender, ['m', 'f'])) {
            return $query;
        }

        return $query->whereHas('profile', function ($query) use ($gender) {
            $query->where('gender',  $gender);
        });
    }

    public function searchableAs()
    {
        return 'users';
    }
}

