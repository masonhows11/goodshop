<?php


namespace App\Services\Message\Email;



use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class MailViewProvider extends Mailable
{
    use Queueable,SerializesModels;

    public $details;
    protected $attachment_files;

    public function __construct($details,$subject,$from,$attachment_files = null)
    {

        $this->details = $details;
        $this->subject = $subject;
        $this->from = $from;
        $this->attachment_files = $attachment_files;
    }

    public function build()
    {
        return $this->subject($this->subject)->view('emails.mail_view');
    }

    public function attachments() : array
    {
        //// for if we want to send array of file other way
        $public_files = [];
        if($this->attachment_files){
            foreach ($this->attachment_files as $file){
                array_push($public_files,public_path($file));
            }
        }
        return $public_files;

        ///// for if we want to send array of file
        //        return  [
        //            Attachment::fromPath($this->attachment_files)->withMime('image/jpg')
        //        ];

        ///// for attach file to email
        //        return [
        //            Attachment::fromPath($this->attachment_files)
        //                ->as('mag_file.png')
        //                ->withMime('image/jpg')
        //        ];
        //        return [
        //          Attachment::fromPath(public_path('/attachment/mag2.jpg'))
        //              ->as('mag.png')
        //              ->withMime('image/jpg')
        //        ];
    }
}
