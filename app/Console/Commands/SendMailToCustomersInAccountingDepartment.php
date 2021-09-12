<?php

namespace App\Console\Commands;

use App\Jobs\SendEmail;
use App\Mail\CommonEmail;
use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailToCustomersInAccountingDepartment extends Command
{
    const ACCOUNTING = 1;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailto:accounting-customers {--queue}';

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
    public function handle(): void
    {
        $customers = Customer::where('department_id', static::ACCOUNTING)->get();
        $isQueued = $this->option('queue');

        if ($isQueued) {
            $this->queueEmail($customers);
        } else {
            $this->sendEmail($customers);
        }
    }

    public function queueEmail($customers): void
    {
        $totalCustomers = count($customers);
        try {
            DB::beginTransaction();

            $bar = $this->output->createProgressBar($totalCustomers);
            $bar->start();

            foreach ($customers as $customer) {
                SendEmail::dispatch($customer);
                $bar->advance();
            }

            $bar->finish();
            $this->showMessage(true, $totalCustomers);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::alert("Muhasebe Birimindeki $totalCustomers Müşterinin Emailleri Sıraya Alınırken Hata Meydana Geldi",[
                $exception->getMessage(), $exception->getLine()
            ]);
        }
    }

    public function sendEmail($customers): void
    {
        $totalSuccess = 0;

        $bar = $this->output->createProgressBar(count($customers));
        $bar->start();

        foreach ($customers as $customer) {
            try {
                $email = new CommonEmail($customer);
                Mail::to($customer->email)->send($email);
                $bar->advance();
                $totalSuccess += 1;
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::alert("Muhasebe Birimindeki Müşterilerden Email Adresi $customer->email Olan Kişiye Email Gönderilirken Hata Meydana Geldi.",[
                    $exception->getMessage(), $exception->getLine()
                ]);
            }
        }

        $bar->finish();
        $this->showMessage(false, $totalSuccess);
    }

    public function showMessage($isQueued, $count): void
    {
        if ($isQueued) {
            $this->info("\n Muhasebe Birimindeki $count Müşterinin Email Gönderimi Sıraya Alındı.");
        } else {
            $this->info("\n Muhasebe Birimindeki $count Müşteriye Email Gönderildi.");
        }
    }
}
