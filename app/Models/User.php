<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;

    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'first_name',
        'last_name',
        'password',
        'terms_agreed',
        'role'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getDefaultAddress()
    {
        $address = $this->addresses()->where('default_address', 1)->first();
        if ($address) {
            return $address;
        }
        return null;
    }

    public function getformattedAddress($address)
    {
        if ($address) {
            return $address['address'] . ',' . $address['area'] . ',' . $address['city'] . ',' . $address['state'] . ',' . $address['pin_code'];
        }
        return null;
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    public function cards()
    {
        return $this->hasMany(UserCard::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites')->withTimestamps();
    }

    public function wishlistProducts()
    {
        return $this->belongsToMany(Product::class, 'wishes_list', 'user_id', 'product_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bookmarkedBlogs()
    {
        return $this->belongsToMany(Blog::class, 'bookmarks', 'user_id', 'blog_id')
            ->withTimestamps();
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'author_id');
    }

    public function settings(){
        return $this->hasOne(UserSetting::class);
    }
}
