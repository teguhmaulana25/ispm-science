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

    public function __construct($var)
    {
        $this->var = $var;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    	if($this->var['type'] == "apply_finish"){
    		return $this->from('igfauzi1@gmail.com')
                   ->view('mails.finishEmail')
                   ->with(
                    [
                        'name' => $this->var['name'],
                        'vacancy_name' => $this->var['vacancy_name'],
                    ]);
    	} elseif($this->var['type'] == "interview_email"){
            return $this->from('igfauzi1@gmail.com')
                   ->view('mails.interviewEmail')
                   ->with(
                    [
                        'name' => $this->var['name'],
                        'date' => $this->var['date'],
                        'address' => "Ruko Jalan Kartini Raya No. 53 Pancoran Mas, Depok 16436 <br> Telp: (021) 7720-7657",
                    ]);
        }
       	
    }
}
