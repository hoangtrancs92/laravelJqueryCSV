<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class KanjiRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match("/[\x{4E00}-\x{9FFF}]+/u", $value);

    }

    public function message()
    {
        return 'Kanji validate';
    }
}

?>
