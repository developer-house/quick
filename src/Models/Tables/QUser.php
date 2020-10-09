<?php


namespace Developerhouse\Quick\Models\Tables;


use Developerhouse\Quick\Traits\QAuth;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int         $id
 * @property string      $names
 * @property string      $surnames
 * @property string      $username
 * @property string      $email
 * @property int         $type_dni_id
 * @property int         $dni
 * @property string      $business
 * @property string      $nit
 * @property int         $gender_id
 * @property int         $state_id
 * @property Carbon      $email_verified_at
 * @property string      $password
 * @property string      $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|QUser newModelQuery()
 * @method static Builder|QUser newQuery()
 * @method static Builder|QUser query()
 * @method static Builder|QUser whereId($value)
 * @method static Builder|QUser whereNames($value)
 * @method static Builder|QUser whereSurnames($value)
 * @method static Builder|QUser whereEmail($value)
 * @method static Builder|QUser whereTypeDniId($value)
 * @method static Builder|QUser whereDni($value)
 * @method static Builder|QUser whereBusiness($value)
 * @method static Builder|QUser whereNit($value)
 * @method static Builder|QUser whereGenderId($value)
 * @method static Builder|QUser whereStaterId($value)
 * @method static Builder|QUser whereEmailVerifiedAt($value)
 * @method static Builder|QUser wherePassword($value)
 * @method static Builder|QUser whereRememberToken($value)
 * @method static Builder|QUser whereCreatedAt($value)
 * @method static Builder|QUser whereUpdatedAt($value)
 * @mixin Eloquent
 */
class QUser extends Authenticatable {

    use QAuth;

    protected $table      = 'users';
    protected $guard_name = 'web';

}