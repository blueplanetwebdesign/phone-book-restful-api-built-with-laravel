<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class PhoneBook extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone_number'];

    /**
     * @var array
     */
    protected $guarded = ['id', 'user_id'];

    /**
     * @var string
     */
    protected $table = 'phone_book';

}
