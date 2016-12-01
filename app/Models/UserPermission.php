<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserPermission
 */
class UserPermission extends Model
{
    protected $table = 'user_permissions';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    protected $guarded = [];

        
}