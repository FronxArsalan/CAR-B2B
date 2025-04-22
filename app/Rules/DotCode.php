<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;

class DotCode implements ValidationRule
{
    /**
     * Validate DOT tire code format
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Skip if empty (use 'nullable' in validator)
        if (empty($value)) {
            return;
        }

        // More flexible format:
        // - DOT prefix (case insensitive)
        // - 3-4 character plant code
        // - 2-4 digit date code
        // - Optional spaces
        $isValid = preg_match('/^DOT\s?[A-Z0-9]{3,4}\s?[A-Z0-9]{2,4}$/i', $value);
        
        if (!$isValid) {
            $fail('The :attribute must be a valid DOT code (e.g., DOT ABCD 1234 or DOT AB 23)');
            return;
        }

        // Extract date components
        $digits = preg_replace('/[^0-9]/', '', $value);
        
        // Minimum 2 digits required for year
        if (strlen($digits) >= 2) {
            $currentYear = date('y');
            $currentWeek = date('W');
            
            // Handle 2-digit format (YY)
            if (strlen($digits) == 2) {
                $year = (int)$digits;
                
                if ($year > $currentYear + 1) {
                    $fail('The :attribute has an invalid manufacturing year');
                }
            } 
            // Handle 3-digit format (WYY)
            elseif (strlen($digits) == 3) {
                $week = (int)substr($digits, 0, 1);
                $year = (int)substr($digits, 1, 2);
                
                $this->validateDateComponents($week, $year, $currentWeek, $currentYear, $fail);
            }
            // Handle 4-digit format (WWYY)
            else {
                $week = (int)substr($digits, -4, 2);
                $year = (int)substr($digits, -2);
                
                $this->validateDateComponents($week, $year, $currentWeek, $currentYear, $fail);
            }
        }
    }

    /**
     * Validate week/year components
     */
    protected function validateDateComponents(
        int $week, 
        int $year, 
        int $currentWeek, 
        int $currentYear, 
        Closure $fail
    ): void {
        // Validate week range
        if ($week < 1 || $week > 52) {
            $fail('The :attribute has an invalid manufacturing week (01-52)');
        }

        // Validate year range (current year - 10 years to +1 year in future)
        if ($year < ($currentYear - 10) || $year > ($currentYear + 1)) {
            $fail('The :attribute has an invalid manufacturing year (must be within last 10 years or next year)');
        }

        // For current year, week can't be in future
        if ($year == $currentYear && $week > $currentWeek) {
            $fail('The :attribute has a future manufacturing date');
        }
    }
}