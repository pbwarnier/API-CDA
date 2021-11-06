<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $primaryKey = 'id_inventories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'inventories';

    protected $fillable = [
        'date',
        'data',
        'id_users',
        'id_properties',
        'id_client_buyer',
        'id_client_seller',
        'id_documents'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}