<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectIsAtOneHundredPercentTime extends Notification
{
    use Queueable;

    public $user;
    public $project;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $project)
    {
        $this->user = $user;
        $this->project = $project;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // @todo OPT-IN ONLY FOR MAIL.
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this->project->title . ' is at 100% time utilized!')
                    ->line('Hey '. $this->user->name)
                    ->line('We just thought we\'d let you know that your project '.$this->project->title.' on Trackr is at 100% time utilised.')
                    ->action('Check Time Logs', route('projects.show', $this->project))
                    ->line('Thanks for using Trackr!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'author'    => 'Trackr Bot',
            'title'     => $this->project->title . ' is at 100% time utilised!',
            'message'   => $this->project->title.' is at 100% time utilised!',
            'link'      => route('projects.show', $this->project)
        ];
    }
}
