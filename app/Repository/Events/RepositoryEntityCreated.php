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


class RepositoryEntityCreated extends RepositoryBaseEvent
{
    protected $action = "created";
}