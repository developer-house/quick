<?php

namespace Developerhouse\Quick\Models\Tables;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Tables\UserSetting
 *
 * @property int         $id
 * @property int         $user_id
 * @property int         $number_of_active_sessions_in_web
 * @property int         $number_of_active_sessions_in_mobiles
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserSetting newModelQuery()
 * @method static Builder|UserSetting newQuery()
 * @method static Builder|UserSetting query()
 * @method static Builder|UserSetting whereCreatedAt($value)
 * @method static Builder|UserSetting whereId($value)
 * @method static Builder|UserSetting whereNumberOfActiveSessionsInMobiles($value)
 * @method static Builder|UserSetting whereNumberOfActiveSessionsInWeb($value)
 * @method static Builder|UserSetting whereUpdatedAt($value)
 * @method static Builder|UserSetting whereUserId($value)
 * @mixin Eloquent
 * @property int         $author_id
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereAuthorId($value)
 */
class UserSetting extends Model {

}
