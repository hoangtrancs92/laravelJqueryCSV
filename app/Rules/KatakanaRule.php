<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class KatakanaRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match("/[\x{30A0}-\x{30FF}ー]+/u", $value);

    }

    public function message()
    {
        return 'Katakana validate';
    }
}

?>
