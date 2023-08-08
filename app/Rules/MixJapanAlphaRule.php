<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MixJapanAlphaRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match("/[\x{3040}-\x{309F}\x{4E00}-\x{9FFF}\x{30A0}-\x{30FF}ー]+/u", $value);

    }

    public function message()
    {
        return ' 3 japan alphabet validate';
    }
}
