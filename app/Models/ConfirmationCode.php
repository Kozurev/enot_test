<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property int $confirmed
 * @property Carbon $expired_at
 *
 * @method static self|Builder byUser(int $userId)
 * @method self|Builder byCode(string $code)
 * @method self|Builder notConfirmed()
 * @method self|Builder notExpired()
 */
class ConfirmationCode extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [

    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'expired_at' => 'datetime'
    ];

    /**
     * @param Builder $builder
     * @param int $userId
     * @return void
     */
    public function scopeByUser(Builder $builder, int $userId): void
    {
        $builder->where('user_id', $userId);
    }

    /**
     * @param Builder $builder
     * @param string $code
     * @return void
     */
    public function scopeByCode(Builder $builder, string $code): void
    {
        $builder->where('code', $code);
    }

    /**
     * @param Builder $builder
     * @return void
     */
    public function scopeNotConfirmed(Builder $builder): void
    {
        $builder->where('confirmed', 0);
    }

    /**
     * @param Builder $builder
     * @return void
     */
    public function scopeNotExpired(Builder $builder): void
    {
        $builder->where('expired_at', '>', now());
    }

}
