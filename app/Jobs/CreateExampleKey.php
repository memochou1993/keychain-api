<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Contracts\KeyInterface as Repository;

class CreateExampleKey implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\User
     */
    protected $user;

    /**
     * @var \App\Contracts\KeyInterface
     */
    protected $reposotory;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Repository $reposotory)
    {
        $reposotory->storeKeyByUser($this->user, [
            'title' => 'title',
            'content' => Crypt::encrypt('content'),
            'tags' => '#tag',
            'password' => true,
        ]);
    }
}
