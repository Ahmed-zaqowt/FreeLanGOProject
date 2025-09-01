<?php

namespace App\Notifications;

use App\Models\Proposal;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProposalNotification extends Notification
{
    use Queueable;
    protected $proposal;
    /**
     * Create a new notification instance.
     */
    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [ 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('عرض جديد على مشروعك : ' . $this->proposal->project->title)
            ->greeting('مرحبا ' . $notifiable->name)
            ->line('تم تقديم عرض جديد على مشروعك' . $this->proposal->project->title)
            ->line('مقدم العرض ' . $this->proposal->freelancer->fullname)
            ->line(' السعر المقترح ' . $this->proposal->bid_amount . " $")
            ->line('  مدة التنفيذ  ' . $this->proposal->delivery_time)
            ->line('   نص العرض  ' . $this->proposal->presentation_text)
            ->line('  شكرا لاستخدامك منصتنا !');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'proposal_id' => $this->proposal->id,
            'project_id' => $this->proposal->project->id,
            'project_title' => $this->proposal->project->title,
            'freelancer_id' => $this->proposal->freelancer_id,
            'freelancer_name' => $this->proposal->freelancer->fullname,
            'bid_amount' => $this->proposal->bid_amount,
            'delivery_time' => $this->proposal->delivery_time,
            'msg' => $this->proposal->presentation_text
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        return new BroadcastMessage([
            'proposal_id' => $this->proposal->id,
            'project_id' => $this->proposal->project->id,
            'project_title' => $this->proposal->project->title,
            'freelancer_id' => $this->proposal->freelancer_id,
            'freelancer_name' => $this->proposal->freelancer->fullname,
            'bid_amount' => $this->proposal->bid_amount,
            'delivery_time' => $this->proposal->delivery_time,
            'msg' => $this->proposal->presentation_text
        ]);
    }

   public function broadcastOn()
    {
        return new PrivateChannel('App.Models.User.' . $this->proposal->project->user_id);
    }
}
