<?php

namespace App\Events\Backend;

use App\Model\Project;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewProjectNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Project
     */
    public $project;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        //
        $this->project = $project;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('new-project-notification');
    }

    public function broadcastAs(){
        return 'NewProjectNotification';
    }
}
