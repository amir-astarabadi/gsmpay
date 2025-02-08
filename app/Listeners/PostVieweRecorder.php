<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use App\Events\PostViewedEvent;
use App\Models\PostView;

class PostVieweRecorder implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostViewedEvent $event): void
    {
        if ($event->userId && PostView::existsBaseUser($event->userId, $event->postId)) {
            return;
        }

        if (PostView::existsBaseIp($event->ipAddress, $event->postId)) {
            return;
        }

        DB::transaction(function () use ($event) {
            $view = PostView::create([
                'ip_address' => $event->ipAddress,
                'user_id' => $event->userId,
                'post_id' => $event->postId,
                'viewed_at' => now()->toDateTimeString(),
            ]);

            $view->post()->update(['views' => DB::raw('views + 1')]);
        });
    }
}
