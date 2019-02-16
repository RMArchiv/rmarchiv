<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Zizaco\Entrust\EntrustRole;

/**
 * App\Models\UserRole.
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserPermission[] $perms
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRole whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole query()
 */
class UserRole extends EntrustRole
{
//
}
