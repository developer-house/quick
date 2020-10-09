<?php

namespace Developerhouse\Quick\Models\Tables;


use DB;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 * Developerhouse\Quick\Models\Tables\LoginAttempt
 *
 * @property int         $id
 * @property int         $user_id
 * @property int         $state_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|LoginHistory newModelQuery()
 * @method static Builder|LoginHistory newQuery()
 * @method static Builder|LoginHistory query()
 * @method static Builder|LoginHistory whereId($value)
 * @method static Builder|LoginHistory whereUserId($value)
 * @method static Builder|LoginHistory whereStateId($value)
 * @method static Builder|LoginHistory whereUpdatedAt($value)
 * @mixin Eloquent
 */
class LoginAttempt extends Model {


    /**
     * @param QUser $user
     * @param int   $state
     */
    public function add(QUser $user, int $state): void {

        try {

            DB::beginTransaction();

            $attempt           = new self();
            $attempt->user_id  = $user->id;
            $attempt->state_id = $state;
            $attempt->save();

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
        }


    }


    /**
     * @param QUser $user
     *
     * @return int
     */
    public function number_of_failed_attempts(QUser $user) {

        return self::whereUserId($user->id)
            ->whereStateId(13)
            ->take(3)
            ->count();

    }

    /**
     * @param QUser $user
     */
    public function clear_login_attempts(QUser $user): void {

        try {

            DB::beginTransaction();

            self::whereUserId($user->id)->update(['state_id' => 14]);

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
        }


    }

}
