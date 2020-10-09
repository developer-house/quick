<?php

namespace Developerhouse\Quick\Models\Tables;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;


/**
 * App\Value
 *
 * @property int            $id
 * @property string         $name
 * @property string         $state
 * @property string|null    $description
 * @property Carbon|null    $created_at
 * @property Carbon|null    $updated_at
 * @method static Builder|Value newModelQuery()
 * @method static Builder|Value newQuery()
 * @method static Builder|Value query()
 * @method static Builder|Value whereCreatedAt($value)
 * @method static Builder|Value whereId($value)
 * @method static Builder|Value whereName($value)
 * @method static Builder|Value whereState($value)
 * @method static Builder|Value whereDescription($value)
 * @method static Builder|Value whereUpdatedAt($value)
 * @method static Builder|Value search($searchTerm, $state)
 * @method static Builder|Value state($state)
 * @mixin Eloquent
 */
class Value extends Model {

    protected $fillable = ['name', 'state',];

    /**
     * Relation One To Much
     *
     * @return HasMany
     */
    public function parameters() {
        return $this->hasMany(Parameter::class)->orderBy('id', 'desc');
    }

    /**
     * @param $query
     * @param $state
     *
     * @return mixed
     */
    public function scopeState($query, $state) {
        return $query->where('state', 'like', '%' . $state . '%');
    }

    /**
     * @param $query
     * @param $search
     * @param $state
     *
     * @return mixed
     */
    public function scopeSearch($query, $search, $state) {
        return $query
            ->where('name', 'like', '%' . $search . '%')
            ->state($state)
            ->orderBy('id', 'desc');
    }


}
