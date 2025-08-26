<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Job;

class NewJobApplication extends Notification
{
    use Queueable;

    private $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New submission request')
                    ->line('Applied for a job: ' . $this->job->title)
                    ->action('View orders', url('/jobs/' . $this->job->id . '/applications'))
                    ->line('Thank you for using our site!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Applied for a job: ' . $this->job->title,
            'job_id' => $this->job->id
        ];
    }
}