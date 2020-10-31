<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendEmailVerificationReminderCommand extends Command
{
    protected $signature = 'send:reminder';

    protected $description = 'Send a reminder to user with unverified account for a week';

    public function handle()
    {
        User::query()
            ->whereDate('created_at', '=', Carbon::now()->subDays(7)->format('Y-m-d'))
            ->whereNull('email_verified_at')
            ->each(function (User $user) {
                // $this->notify(new VerifyEmail);
                $user->sendEmailVerificationNotification();
            });
    }
}
