<?php
/**
 * 功能：
 *
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace App\Exceptions;


class PrettyException extends \Exception
{
    public function __construct($msg = 'Error found.', $code = -1, $render = false)
    {
        parent::__construct($msg, $code);

        if ($render) {
            $this->showError();
            exit;
        }
    }

    public function showError()
    {
        return response()->json(['code' => $this->code, 'message' => $this->message], 500);
    }


}