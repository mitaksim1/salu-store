<?php
namespace App\Notification;

use App\Entity\Clothes;
use App\Entity\Contact;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ContactNotification 
{ 
    private $mailer;

    public function __construct(MailerInterface $mailer) 
    {
        $this->mailer = $mailer;
    }

    public function notify(Contact $contact)
    {
        $clothes = new Clothes(); 
        
        $message = (new TemplatedEmail())->from('noreply@salu-store.com')
            ->to(new Address('contact@salu-store.com'))
            ->subject('Gostaria de ter mais informaçoes sobre ' . $clothes->getName())
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'contact' => $contact,
                'clothes' => $clothes
            ]);

        $this->mailer->send($message);
    }
}