<?php
class SendGridProvider extends Kirby\Email\Email {
    public function send(): bool {
      require('vendor/autoload.php');
      $email    = new \SendGrid\Mail\Mail();
      
      // encode any attachments we might have
      if ($this->attachments()) {
          $encodedAttachment = base64_encode(file_get_contents($this->attachments()[0]));
      }     
      
      // we are only supporting one recipient per field
      $email->setFrom($this->from(), $this->fromName());
      $email->setSubject($this->subject());
      $email->addTo(array_key_first($this->to()));
      $email->addBCC(array_key_first($this->bcc()));
      $email->addContent('text/plain', $this->body()->text());
      
      if ($this->attachments()) {
        $email->addAttachment($encodedAttachment, 'text/CSV', 'order.csv', 'attachment');
      }
                        
      // authenticate      
      $apiKey = getenv('SENDGRID_API_KEY'); 
      $sendgrid = new \SendGrid($apiKey);
      
      try {
        $response = '';
        $response = $sendgrid->send($email);
      } catch (Exception $e) {
        echo 'Error '. $e->getMessage() .'\n';
      }       
      
      if (isset($e)) {
        return $e->getMessage();
      } else {
        return 'Email sent.';
      }
    }
}

Kirby::plugin('my/sendgrid', [
    'components' => [
        'email' => function ($kirby, $props, $debug) {
            return new SendGridProvider($props, $debug);
        }
    ]
]);
