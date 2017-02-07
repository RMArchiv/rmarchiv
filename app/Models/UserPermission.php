<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

/**
 * Class UserPermission.
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserRole[] $roles
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserPermission extends EntrustPermission
{
    //
}
