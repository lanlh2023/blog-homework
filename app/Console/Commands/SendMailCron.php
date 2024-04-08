<?php

namespace App\Console\Commands;

use App\Mail\SendMailForUpdatePost;
use App\Repositories\RepositoryInterface\PostRepositoryInterface;
use App\Repositories\RepositoryInterface\SendMailRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailCron extends Command
{
    protected SendMailRepositoryInterface $sendMailRepostiory;

    protected PostRepositoryInterface $postRepostiory;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail every minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SendMailRepositoryInterface $sendMailRepostiory, PostRepositoryInterface $postRepostiory)
    {
        parent::__construct();
        $this->sendMailRepostiory = $sendMailRepostiory;
        $this->postRepostiory = $postRepostiory;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Start '.$this->signature.' : '.now());

        $autoListSendMail = $this->sendMailRepostiory->getAllWithKeySend(['id', 'email', 'post_id']);

        foreach ($autoListSendMail as $sendMailItem) {
            DB::beginTransaction();
            try {
                Mail::to($sendMailItem->email)
                    ->send(new SendMailForUpdatePost($this->postRepostiory->getById($sendMailItem->post_id)));
                $this->sendMailRepostiory->update($sendMailItem->id, ['key_send' => 1]);
                DB::commit();
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
                Log::error("Email send failed with mail $sendMailItem->email");
                DB::rollBack();

                continue;
            }
        }
        Log::info('End '.$this->signature.' : '.now());
        Log::info('End '.$this->signature.' : '.now());

    }
}
