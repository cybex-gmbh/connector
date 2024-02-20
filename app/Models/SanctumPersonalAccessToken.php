<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken;

/**
 * App\Models\SanctumPersonalAccessToken
 *
 * @property int $id
 * @property string $tokenable_type
 * @property int $tokenable_id
 * @property string $name
 * @property string $token
 * @property array|null $abilities
 * @property \Illuminate\Support\Carbon|null $last_used_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $tokenable
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken whereAbilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken whereTokenableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken whereTokenableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SanctumPersonalAccessToken whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SanctumPersonalAccessToken extends PersonalAccessToken
{
    protected $connection;

    protected $table = 'personal_access_tokens';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = config('connector.secondary_database.connection');
    }
}
