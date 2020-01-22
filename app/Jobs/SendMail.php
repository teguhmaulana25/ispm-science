<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActionEmail;

use Illuminate\Contracts\Queue\Queue;
use Log;
class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $details;
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $data = $this->details;
        $mailer->to('maulanateguh87@gmail.com')->queue(new ActionEmail([
            'type' => $data['type'],
            'name' => $data['name'],
            'date' => $data['date']
        ]));
        // var_dump($data);
        // $mailer->to('maulanateguh87@gmail.com')->queue(new SmsBroadcastMail([
        //     'student_id' => $this->student,
        //     //'phone' => $value->contact_number,
        //     'phone' => 'maulanateguh87@gmail.com',
        //     'message' => $this->message
        // ]));
        // $email = new ActionEmail($this->details);
      // $data = $this->recipient;
        // $mailer->to('maulanateguh87@gmail.com')->queue(new ActionEmail($this->details));

        // $mailer->send('emails.sms_broadcast_mail', [
      //     'student' => $this->student,
      //     'message' => $this->message,
      //   ], function ($message) use ($data) {
      //     $message->from('support@lhjakarta.com', 'Lighthouse');
      //     $message->to($data['phonenumber']);
      //     $message->subject('SMS Broadcast Mail - TEST');
      // });

        // Mail::to($this->details['email'])->send($email);
        // Mail::to($details->)
        //     [
        //         'type' => 'interview_email',
        //         'name' => $this->getCandidate($value['candidate'])->name,
        //         'date' => \Carbon\Carbon::parse($input['interview_date'])->format('l, j F Y \\a\\t h:i A'),
        //     ]));
        // return $this->from('maulanateguh87@gmail.com')
        //         ->subject('Interview - Dumet Career')
        //         ->view('mails.interviewEmail')
        //         ->with([
        //             'name' => $this->var['name'],
        //             'date' => $this->var['date'],
        //             'address' => "Ruko Jalan Kartini Raya No. 53 Pancoran Mas, Depok 16436 <br> Telp: (021) 7720-7657",
        //         ]);
    }
}
