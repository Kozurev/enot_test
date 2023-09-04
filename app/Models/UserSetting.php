<?php

namespace App\Models;

use App\Enums\NotificationTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property NotificationTypeEnum $notification_type
 *
 * @method static self|Builder byUser(int $userId)
 */
class UserSetting extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'notification_type'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $casts = [
        'notification_type' => NotificationTypeEnum::class
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

}
