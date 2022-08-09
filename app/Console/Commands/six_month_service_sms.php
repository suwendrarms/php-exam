<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SmsController;

class six_month_service_sms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:six_month_service_sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $data = new SmsController;
        $data->sendSixMonthSms();
    }
}
