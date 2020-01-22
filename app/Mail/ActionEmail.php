<?php
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
 
class ActionEmail extends Mailable
{
    use Queueable, SerializesModels;
 
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
   // public $order;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    	if($this->data['type'] == "apply_finish"){
            return $this->from('support@asvicode.com', 'Dumet Careers')
                ->view('mails.finishEmail')
                ->with([
                    'name' => $this->data['name'],
                    'vacancy_name' => $this->data['vacancy_name'],
                ]);
    	} elseif($this->data['type'] == "interview_email"){
            return $this->from('support@asvicode.com', 'Dumet Careers')
                ->subject('Interview - Dumet Career')
                ->view('mails.interviewEmail')
                ->with([
                    'name' => $this->data['name'],
                    'date' => $this->data['date'],
                    'address' => "Ruko Jalan Kartini Raya No. 53 Pancoran Mas, Depok 16436 <br> Telp: (021) 7720-7657",
                ]);
        } elseif($this->data['type'] == "onboarding_email"){
                return $this->from('support@asvicode.com', 'Dumet Careers')
                    ->subject('Onboarding - Dumet Career')
                    ->view('mails.onboardingEmail')
                    ->with([
                        'name' => $this->data['name'],
                        'date' => $this->data['date'],
                        'address' => "Ruko Jalan Kartini Raya No. 53 Pancoran Mas, Depok 16436 <br> Telp: (021) 7720-7657",
                    ]);
        }

    }
}
