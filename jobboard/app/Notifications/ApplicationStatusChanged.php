<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Application;

class ApplicationStatusChanged extends Notification
{
    use Queueable;

    private $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage) 
                    ->subject('Update on application')
                    ->line('Your application status has been updated on the job: '. $this->application->job->title)
                    ->line('New status: ' . $this->application->status)
                    ->action('Job Offer ', url('/jobs/' . $this->application->job->id))
                    ->line('Thank you for using our site!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your status has been updated in a post: ' . $this->application->job->title,
            'status' => $this->application->status,
            'job_id' => $this->application->job->id
        ];
    }
}