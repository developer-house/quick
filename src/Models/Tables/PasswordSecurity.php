<?php

namespace Developerhouse\Quick\Models\Tables;

use Eloquent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


/**
 * namespace Developerhouse\Quick\Models\Tables\PasswordSecurity
 *
 * @property int         $id
 * @property int         $user_id
 * @property int         $google2fa_enable
 * @property string|null $google2fa_secret
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordSecurity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordSecurity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordSecurity query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordSecurity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordSecurity whereGoogle2faEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordSecurity whereGoogle2faSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordSecurity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordSecurity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordSecurity whereUserId($value)
 * @mixin Eloquent
 */
class PasswordSecurity extends Model {

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }


}
