<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;

class SendConfirmation extends Job
{
	protected $code = 'code';
	protected $email = 'name';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->code = $data['code'];
        $this->email = $data['email'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Mail::to(); send mail here
    }
}
