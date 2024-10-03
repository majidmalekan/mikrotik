<?php

namespace App\Traits;

use App\Exceptions\CommonException;
use App\Notifications\SendEmail;
use Illuminate\Mail\SentMessage;

trait SendMailTrait
{

    /**
     * @param string $sendTo
     * @param string $subjectEmail
     * @param string $viewPage
     * @param array|null $data
     * @param array $attachFile
     * @return SentMessage|null
     * @throws CommonException
     */
    public function sendMail(string $sendTo, string $subjectEmail, string $viewPage,  array|null $data ,array $attachFile=[]): ?SentMessage
    {
        return (new SendEmail($sendTo,$subjectEmail,$viewPage,$data,$attachFile))->sendMail();
    }


}
