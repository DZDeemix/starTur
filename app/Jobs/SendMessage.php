<?php

namespace App\Jobs;

use App\Events\SkiResortEvent;
use App\Mail\SkiResortMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $to = '';
    protected $object_mail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $to)
    {
        $this->data = $data;
        $this->to = $to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->to)->send(new SkiResortMail(['parsed_data' => $this->data]));
        broadcast(new SkiResortEvent(true));
    }
}
