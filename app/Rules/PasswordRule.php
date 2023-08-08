<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[0-9a-zA-Z]+$/', $value);
    }

    public function message()
    {
        return 'パスワードには半角数字のみ、または半角英字のみの値は使用できません。';
    }
}

?>
