<?php

namespace Developerhouse\Quick\Models\Tables;


use Developerhouse\Quick\Http\Beans\UserSessionBean;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 * App\Models\Tables\UserSession
 *
 * @property int         $id
 * @property int|null    $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $file_name
 * @property int|null    $medium_id
 * @property int         $state_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserSession newModelQuery()
 * @method static Builder|UserSession newQuery()
 * @method static Builder|UserSession query()
 * @method static Builder|UserSession whereCreatedAt($value)
 * @method static Builder|UserSession whereFileName($value)
 * @method static Builder|UserSession whereId($value)
 * @method static Builder|UserSession whereIpAddress($value)
 * @method static Builder|UserSession whereMediumId($value)
 * @method static Builder|UserSession whereStateId($value)
 * @method static Builder|UserSession whereUpdatedAt($value)
 * @method static Builder|UserSession whereUserAgent($value)
 * @method static Builder|UserSession whereUserId($value)
 * @mixin Eloquent
 */
class UserSession extends Model {


    /**
     * @param UserSessionBean $bean
     *
     * @return UserSession
     */
    public static function add(UserSessionBean $bean): UserSession {

        $session             = new self();
        $session->user_id    = $bean->getUserId();
        $session->ip_address = $bean->getIpAddress();
        $session->user_agent = $bean->getUserId();
        $session->medium_id  = $bean->getMediumId();
        $session->state_id   = $bean->getStateId();
        $session->save();

        return $session;

    }
}
