<?php

namespace App\Jobs;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class OrderChangeSupplier implements ShouldQueue
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
            $Supplier = User::where('user_id',$content['msSupplier'])->first();
            $message->from('noreply@alium.vn', 'Alium.vn');
            if ($Supplier && $Supplier->user_email
                && filter_var($Supplier->user_email, FILTER_VALIDATE_EMAIL)){
                $message->to($Supplier->user_email)->subject($content['msTitle']);
            }

        });
    }
}
