<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class OrderChangeSale implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $content;
    protected $saleId;
    public function __construct($content, $saleId)
    {
        $this->content = $content;
        $this->saleId = $saleId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->saleId > 0) {
            $content = $this->content;
            Mail::send('mail.order_change_admin', $content, function ($message) use ($content) {
                $sale = User::where('user_id', $this->saleId)->first();
                $message->from('noreply@alium.vn', 'Alium.vn');
                if ($sale && $sale->user_email
                    && filter_var($sale->user_email, FILTER_VALIDATE_EMAIL)) {
                    $message->to($sale->user_email)->subject($content['msTitle']);
                }
            });
        }
    }
}
