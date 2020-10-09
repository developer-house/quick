<?php

namespace Developerhouse\Quick\Models\Tables;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tables\ModelHasRoles
 *
 * @property int    $role_id
 * @property string $model_type
 * @property int    $model_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tables\ModelHasRoles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tables\ModelHasRoles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tables\ModelHasRoles query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tables\ModelHasRoles whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tables\ModelHasRoles whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tables\ModelHasRoles whereRoleId($value)
 * @mixin \Eloquent
 */
class ModelHasRoles extends Model {

    public $timestamps = false;

}
