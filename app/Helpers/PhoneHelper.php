<?php

namespace App\Helpers;

class PhoneHelper
{
    public static function normalize(?string $number): ?string
    {
        if (!$number) return null;

        // تبدیل اعداد فارسی و عربی به انگلیسی
        $persian = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        $arabic  = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        $english = ['0','1','2','3','4','5','6','7','8','9'];
        $number  = str_replace(array_merge($persian, $arabic), $english, $number);

        // حذف هر چیزی غیر از عدد
        $number = preg_replace('/\D+/', '', $number);

        // نرمال‌سازی به فرمت ایران
        if (str_starts_with($number, '0098')) {
            $number = '0' . substr($number, 4);
        } elseif (str_starts_with($number, '98')) {
            $number = '0' . substr($number, 2);
        } elseif (str_starts_with($number, '+98')) {
            $number = '0' . substr($number, 3);
        }

        return $number;
    }
}