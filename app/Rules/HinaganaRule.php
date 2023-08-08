<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HinaganaRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match("/[\x{3040}-\x{309F}ー]+/u", $value);

    }

    public function message()
    {
        return 'Hinagana validate';
    }
}

?>
