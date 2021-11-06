<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $primaryKey = 'id_clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'clients';

    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'adress',
        'phone',
        'comment',
        'type'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}