<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SingleByteRule implements Rule
{
    public function passes($attribute, $value)
    {
        return mb_strlen($value, 'UTF-8') === strlen($value);
    }

    public function message()
    {
        return 'singlebyte validate';
    }
}

?>
