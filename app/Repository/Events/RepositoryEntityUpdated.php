<?php
/**
 * 功能：
 *
 * @project     larasite
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace App\Repository\Events;


class RepositoryEntityUpdated extends RepositoryBaseEvent
{
    protected $action = "updated";
}