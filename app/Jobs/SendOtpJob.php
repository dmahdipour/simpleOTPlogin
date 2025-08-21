<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class SendOtpJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $mobile;

    public function __construct(string $mobile) {
        $this->mobile = $mobile;
    }

    public function handle(): void {
        $otp = rand(1000, 9999);
        Redis::setex("otp:{$this->mobile}", 300, $otp);

        // TODO: ارسال SMS واقعی
        \Log::info("OTP for {$this->mobile}: {$otp}");
    }
}