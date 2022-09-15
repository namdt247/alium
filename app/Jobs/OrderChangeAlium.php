<?php

namespace App\Jobs;

use App\Http\DAL\DAL_Config;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class OrderChangeAlium implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $content;
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = $this->content;
        Mail::send('mail.order_change_admin', $content, function ($message) use ( $content) {
            $lstManager = User::permission('sale manager')->where('user_email','!=','')
                ->where('user_role',DAL_Config::ROLE_USER_MOD)
                ->pluck('user_email');
            $message->from('noreply@alium.vn', 'Alium.vn');
            if (count($lstManager) > 0){
                $message->to($lstManager->toArray())->subject($content['msTitle']);
            }

        });
    }
}
