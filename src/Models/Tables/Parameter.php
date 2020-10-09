<?php


namespace Developerhouse\Quick\Models\Tables;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int         $id
 * @property int         $value_id
 * @property string      $name
 * @property string      $state
 * @property string      $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Parameter newModelQuery()
 * @method static Builder|Parameter newQuery()
 * @method static Builder|Parameter query()
 * @method static Builder|Parameter whereCreatedAt($value)
 * @method static Builder|Parameter whereDescription($value)
 * @method static Builder|Parameter whereId($value)
 * @method static Builder|Parameter whereName($value)
 * @method static Builder|Parameter whereState($value)
 * @method static Builder|Parameter whereUpdatedAt($value)
 * @method static Builder|Parameter whereValueId($value)
 * @method static Builder|Parameter states()
 * @method static Builder|Parameter typeDni()
 * @mixin Eloquent
 */
class Parameter extends Model {

}