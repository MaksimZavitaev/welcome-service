<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;
use Illuminate\Notifications\Notifiable;
use App\Notifications\SendLink;

class Employee extends Model implements AuthenticatableContract, AuthorizableContract
{
    use SoftDeletes;

    use Authenticatable, Authorizable;

    use Notifiable;

    protected $fillable = [
        'department',
        'position',
        'firstname',
        'lastname',
        'patronymic',
        'email',
        'mobile_number',
        'work_number',
        'extension_number',
        'short_url',
        'mail_sended_at',
        'sms_sended_at',
    ];

    public function getFullnameAttribute(): string
    {
        return title_case(("{$this->lastname} {$this->firstname}").(" {$this->patronymic}" ?? ''));
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class)->using(EmployeePage::class)->withPivot('content', 'block', 'steps');
    }

    public function getFirstDayPage()
    {
        $page = $this->pages()->whereSlug('first_day')->first() ?? Page::whereSlug('first_day')->first();
        if(!$page) {
            return $page;
        }

        $page = $page->toArray();
        if(array_key_exists('pivot', $page)) {
            $page = array_merge($page, $page['pivot']);
            unset($page['pivot']);
        }

        return array2object($page);
    }

    public function getAuthUrl()
    {
        $query = [
            'sign' => encrypt(json_encode([
                'id' => $this->id,
            ])),
        ];

        return route('auth.login', $query);
    }

    public function sendWelcomeMail()
    {
        Mail::to($this->email)->send(new Welcome($this));
        $this->update(['mail_sended_at' => now()]);
    }

    public function sendWelcomeSms()
    {
        $this->notify(new SendLink($this->short_url));
        $this->update(['sms_sended_at' => now()]);
    }

    /**
     * Route notifications for the SMS channel.
     *
     * @return string
     */
    public function routeNotificationForSms()
    {
        return $this->mobile_number;
    }
}
