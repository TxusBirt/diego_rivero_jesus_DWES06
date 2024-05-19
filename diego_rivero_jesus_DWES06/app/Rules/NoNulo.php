<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoNulo implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        // Verifica si el valor actual del ID es igual al valor original
        if (is_null($value ) || $value == '') {
            $fail('No se permite dejar el campo sin rellenar');
            
        }
        
        
    }
}
