<?php
namespace App\Classes\Computation\Payroll;

class Salary {

    public function annual($entry, $type) {
        switch($type) {
            case "monthly":
                $output = $entry * 12;
                return $output;

                break;

            case "semi_monthly":
                $output = $entry * 24;
                return $output;
                
                break;
                
            case "weekly":
                $output = $entry * 52;
                return $output;
                
                break;
                
            case "daily":
                $output = $entry * 260;
                return $output;
                
                break;

            case "hourly":
                $output = $entry * 2496;
                return $output;
                
                break;

            default:
                return false;
        }
    }

    public function monthly($entry, $type) {
        switch($type) {
            case "annual":
                $output = $entry/12;
                return $output;

                break;
            case "semi_monthly":
                $output = $entry * 2;
                return $output;
                
                break;
                
            case "weekly":
                $output = $entry * 4.33;
                return $output;
                
                break;
                
            case "daily":
                $output = $entry * 21.67;
                return $output;
                
                break;

            case "hourly":
                $output = $entry * 208;
                return $output;
                
                break;
            default:
                return false;
        }
    }

    public function semi_monthly($entry, $type) {
        switch($type) {
            case "annual":
                $output = $entry/24;
                return $output;
                
                break;

            case "monthly":
                $output = $entry/2;
                return $output;
                
                break;
                
            case "weekly":
                $output = $entry * 2.167;
                return $output;
                
                break;
                
            case "daily":
                $output = $entry * 10.83;
                return $output;
                
                break;

            case "hourly":
                $output = $entry * 104;
                return $output;
                
                break;
            default:
                return $entry;
        }
    }
    
    public function weekly($entry, $type) {
        switch($type) {
            case "annual":
                $output = $entry/52;
                return $output;
                
                break;

            case "monthly":
                $output = $entry/4.33;
                return $output;
                
                break;

            case "semi_monthly":
                $output = $entry/2.167;
                return $output;
                
                break;

            case "daily":
                $output = $entry * 5;
                return $output;
                
                break;

            case "hourly":
                $output = $entry * 48;
                return $output;
                
                break;
                
            default:
                return false;
        }
    }

    public function daily($entry, $type) {
        switch($type) {
            case "annual":
                $output = $entry/260;
                return $output;
                
                break;
            case "monthly":
                $output = $entry/21.67;
                return $output;
                
                break;
            case "semi_monthly":
                $output = $entry/10.82;
                return $output;
                
                break;

            case "weekly":
                $output = $entry/5;
                return $output;
                
                break;

            case "hourly":
                $output = $entry * 9.6;
                return $output;
                
                break;
            default:
                return false;
        }
    }

    public function hourly($entry, $type) {
        switch($type) {
            case "annual":
                $output = $entry/2496;
                return $output;
                
                break;
            case "monthly":
                $output = $entry/208;
                return $output;
                
                break;

            case "semi_monthly":
                $output = $entry/104;
                return $output;
                
                break;

            case "weekly":
                $output = $entry/48;
                return $output;
                
                break;

            case "daily":
                $output = $entry/9.6;
                return $output;
                
                break;

            default:
                return false;
        }
    }

}