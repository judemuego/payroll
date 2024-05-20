<?php
namespace App\Classes\Computation\Payroll;

use App\SSS as SSS_Benefits;

class SSS {
    public function getLastRange($end, $range) {
        $endrange = $end + $range;
        return $endrange;
    }

    public function getValue($salary) {
        
        if($salary > 30000) {
            $sss = SSS_Benefits::orderBy('id', 'desc')->firstOrFail();
        }
        else {
            $sss = SSS_Benefits::whereRaw('? BETWEEN range_1 and range_2', [$salary])->firstOrFail();
        }
        return $sss;
    }
}