<?php

namespace App\Models;

use App\Traits\HasRecordOwnerProperties;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use InteractsWithMedia;
    use HasRecordOwnerProperties;
    use LogsActivity;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var string[]
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'name',
        'email_verified_at',
        'remember_token',
        'is_active',
        'created_at',
        'updated_at',
        'added_by',
        'updated_by',
        'login_reactive_time',
        'login_retry_limit',
        'reset_password_expire_time',
        'reset_password_code',
        'user_type',
        'otp',
        'otp_attempt',
        'otp_last_attempt',
        'otp_created_at',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'otp',
        'otp_attempt',
        'otp_last_attempt',
        'otp_created_at',
        'password',
        'remember_token',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'username' => 'string',
        'password' => 'string',
        'email' => 'string',
        'name' => 'string',
        'remember_token' => 'string',
        'is_active' => 'boolean',
        'added_by' => 'integer',
        'updated_by' => 'integer',
        'login_reactive_time' => 'datetime',
        'login_retry_limit' => 'integer',
        'reset_password_expire_time' => 'datetime',
        'reset_password_code' => 'string',
        'user_type' => 'integer',
        'otp' => 'integer',
        'otp_attempt' => 'integer',
        'otp_created_at' => 'datetime',
        'otp_last_attempt' => 'datetime',
    ];

    public const DEFAULT_ROLE = 'System User';

    public const TYPE_USER = 1;
    public const TYPE_ADMIN = 2;

    public const USER_TYPE = [
        self::TYPE_USER => 'User',
        self::TYPE_ADMIN => 'Admin',
    ];

    public const PLATFORM = [
        'ADMIN' => 1,
        'DEVICE' => 2,
        'CLIENT' => 3,
        'DESKTOP' => 4,
    ];

    public const USER_ROLE = [
        'USER' => 1,
        'ADMIN' => 2,
    ];

    public const MAX_LOGIN_RETRY_LIMIT = 3;
    public const LOGIN_REACTIVE_TIME = 0;

    public const FORGOT_PASSWORD_WITH = [
        'link' => [
            'email' => true,
            'sms' => false,
        ],
        'expire_time' => '20',
    ];

    public const LOGIN_ACCESS = [
        'User' => [self::PLATFORM['DEVICE'], self::PLATFORM['DESKTOP'], self::PLATFORM['CLIENT']],
        'Admin' => [self::PLATFORM['ADMIN'], self::PLATFORM['CLIENT'], self::PLATFORM['DESKTOP']],
    ];

    public const OTP = [
        'reset_attempt_time' => 5, // in minutes
        'max_attempts' => 5,
        'expire_time' => 60,  // in minutes
    ];

    public function routeNotificationForNexmo($notification)
    {
        return $this->phone_number; // e.g "91909945XXXX"
    }

    protected static $logAttributes = ['id', 'username', 'password', 'email', 'name', 'email_verified_at', 'remember_token', 'is_active', 'created_at', 'updated_at', 'added_by', 'updated_by'];
}
