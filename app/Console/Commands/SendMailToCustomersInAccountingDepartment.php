<?php

namespace App\Console\Commands;

use App\Jobs\SendEmail;
use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailToCustomersInAccountingDepartment extends Command
{
    const ACCOUNTING = 1;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailto:accounting-customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail To Customers In Accounting Department Every Morning At 8am';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $customers = Customer::where('department_id', static::ACCOUNTING)->get();

        foreach($customers as $customer) {
            SendEmail::dispatch($customer);
        }
    }
}
