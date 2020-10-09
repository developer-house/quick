<?php

namespace Developerhouse\Quick\Models\Tables;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Carbon;


/**
 * App\LoginHistory
 *
 * @property int         $id
 * @property int         $user_id
 * @property string|null $ip_address
 * @property string|null $operating_system
 * @property string|null $browser
 * @property string|null $browser_version
 * @property int         $medium_id
 * @property int         $state_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|LoginHistory newModelQuery()
 * @method static Builder|LoginHistory newQuery()
 * @method static Builder|LoginHistory query()
 * @method static Builder|LoginHistory whereBrowser($value)
 * @method static Builder|LoginHistory whereBrowserVersion($value)
 * @method static Builder|LoginHistory whereCreatedAt($value)
 * @method static Builder|LoginHistory whereId($value)
 * @method static Builder|LoginHistory whereIpAddress($value)
 * @method static Builder|LoginHistory whereOperatingSystem($value)
 * @method static Builder|LoginHistory whereMediumId($value)
 * @method static Builder|LoginHistory whereStateId($value)
 * @method static Builder|LoginHistory whereUpdatedAt($value)
 * @method static Builder|LoginHistory whereUserId($value)
 * @mixin Eloquent
 */
class LoginHistory extends Model {

    /**
     * @param QUser $user
     * @param array $info
     * @param int   $state
     * @param int   $medium
     *
     * @return LoginHistory
     */
    public static function add(QUser $user, array $info, int $state, int $medium) {

        $history                   = new self();
        $history->user_id          = $user->id;
        $history->ip_address       = $info['ip'];
        $history->operating_system = $info['os'];
        $history->browser          = $info['browser'];
        $history->browser_version  = $info['version'];
        $history->medium_id        = $medium;
        $history->state_id         = $state;
        $history->save();

        return $history;

    }

}
