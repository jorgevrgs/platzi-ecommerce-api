<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\NewsletterNotification;

class SendNewsletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsletter
    {emails?*: Email to send message directly}
    {--s|schedule: Send message directly or scheduled}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a newsletter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // dd('Hello world');
        $userEmails = $this->argument('emails');

        $builder = User::query();

        if ($userEmails) {
            $builder->whereIn('email', $userEmails);
        }

        $builder->whereNotNull('email_verified_at');

        if ($count = $builder->count()) {
            $this->info("{$count} emails to send");

            $this->output->progressStart($count);

            if ($this->confirm('¿Are you ready?')) {
                $builder->each(function (User $user) {
                    $user->notify(new NewsletterNotification());
                    $this->output->progressAdvance();
                });

                $this->info("{$count} emails sent");
                $this->output->progressFinish();

                return;
            }
        }

        $this->info('No emails sent');

    }
}
