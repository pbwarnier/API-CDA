<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $primaryKey = 'id_properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'properties';

    protected $fillable = [
        'name',
        'price',
        'reference',
        'nb_room',
        'description',
        'area',
        'type',
        'rental_expenses',
        'availability',
        'country',
        'zip_code',
        'city',
        'adress',
        'furniture',
        'garage',
        'garden',
        'energy_class',
        'id_users',
        'id_clients'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}