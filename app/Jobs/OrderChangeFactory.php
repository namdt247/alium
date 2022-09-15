<?php

namespace App\Jobs;

use App\Models\Supplier;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class OrderChangeFactory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $content;
    protected $factoryId;
    public function __construct($content, $factoryId)
    {
        $this->content = $content;
        $this->factoryId = $factoryId;
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
            $supplier = Supplier::where('sp_id', $this->factoryId)->first();
            $message->from('noreply@alium.vn', 'Alium.vn');
            if ($supplier && $supplier->sp_email
                && filter_var($supplier->sp_email, FILTER_VALIDATE_EMAIL)) {
                $message->to($supplier->sp_email)->subject($content['msTitle']);
            }
        });
    }
}
