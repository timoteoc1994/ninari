<?php

namespace App\Jobs;

use App\Mail\CertificateDownloadLink;
use App\Models\CertificateRecipient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCertificateEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $recipient;

    public function __construct(CertificateRecipient $recipient)
    {
        $this->recipient = $recipient;
    }

    public function handle()
    {
        if ($this->recipient->email) {
            Mail::to($this->recipient->email)->send(new CertificateDownloadLink($this->recipient));

            $this->recipient->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        }
    }
}
