<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $id
 * @property int $bx_user_id
 * @property string $name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $phone
 * @property string $gender
 * @property string $company
 * @property string $country
 * @property string $city
 * @property string $address
 * @property string $image
 * @property string $contact_person
 * @property string $tax_code
 * @property string $person_type
 * @property boolean $status
 * @property string $last_auth
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Cart[] $carts
 * @property ImproveRating[] $improveRatings
 * @property Wishlist[] $wishlists
 */
class User extends Authenticatable implements MustVerifyEmail
{

    use Notifiable;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['bx_user_id', 'name', 'last_name', 'username', 'email', 'email_verified_at', 'password', 'phone', 'gender', 'company', 'country', 'city', 'address', 'image', 'contact_person', 'tax_code', 'person_type', 'status', 'last_auth', 'remember_token', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCountry()
    {
        return $this->belongsTo(Country::class, 'country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function improveRatings()
    {
        return $this->hasMany(ImproveRating::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
