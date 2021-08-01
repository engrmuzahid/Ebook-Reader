<?php

namespace Modules\User\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The user entity.
     *
     * @var \Modules\User\Entities\User
     */
    public $user;

    /**
     * Reset complete form url.
     *
     * @var string
     */
    public $url;

    /**
     * Create a new instance.
     *
     * @param \Modules\User\Entities\User $user
     * @param string $url
     *
     * @return void
     */
    public function __construct($user, $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('user::mail.reset_your_account_password'))
            ->view("user::admin.emails.reset_password", [
                'logo' => NULL,
            ]);
    }
}
