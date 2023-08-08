<?php
namespace App\Rules;

use App\Helpers\ErrorMessagesHelper;
use Illuminate\Contracts\Validation\Rule;

class MailCustomRule implements Rule
{
    public function passes($attribute, $value)
    {
        return  preg_match('/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@([a-zA-Z0-9]+\.)*[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](\.[a-zA-Z]{2,})+$/', $value);
    }

    public function message()
    {
        return ErrorMessagesHelper::getErrorMessage('EBT005');
    }
}

?>
