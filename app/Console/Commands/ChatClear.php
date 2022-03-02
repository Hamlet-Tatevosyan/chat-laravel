<?php

namespace App\Console\Commands;

use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ChatClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Chat';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Chat::whereDate('created_at', '<=', Carbon::now()->subDays(1))->delete();
    }
}
