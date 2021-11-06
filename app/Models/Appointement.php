<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointement extends Model
{
    
    protected $table = 'appointements';
    protected $primaryKey = 'id_appointements';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title',
        'date',
        'description'
        ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}