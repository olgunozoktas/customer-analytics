<?php

namespace App\Console\Commands;

use App\Jobs\SendEmail;
use App\Models\Customer;
use Illuminate\Console\Command;

class SendMailToCustomersInMarketingDepartment extends Command
{
    const MARKETING = 2;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailto:marketing-customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail To Customers In Marketing Department Every Night At 12pm';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $customers = Customer::where('department_id', static::MARKETING)->get();

        foreach($customers as $customer) {
            SendEmail::dispatch($customer);
        }
    }
}
