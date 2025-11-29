<?php

namespace App\Mail;

use App\Models\CertificateRecipient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificateDownloadLink extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $url;

    public function __construct(CertificateRecipient $recipient)
    {
        $this->recipient = $recipient;
        $this->url = route('certificate.download', ['token' => $recipient->token]);
    }

    public function build()
    {
        return $this->subject('Tu Certificado está listo para descargar')
            ->view('emails.certificate_link');
    }
}
