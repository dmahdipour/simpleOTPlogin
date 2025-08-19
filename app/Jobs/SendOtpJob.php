<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendOtpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mobile;
    protected $otp;

    public function __construct($mobile, $otp) {
        $this->mobile = $mobile;
        $this->otp = $otp;
    }

    public function handle() {
        Log::info("Send OTP {$this->otp} to {$this->mobile}");
    }
}