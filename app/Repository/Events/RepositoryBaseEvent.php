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


use Illuminate\Database\Eloquent\Model;
use App\Repository\RepositoryInterface;

abstract class RepositoryBaseEvent
{
    protected $model;
    protected $repository;
    protected $action;

    public function __construct(RepositoryInterface $repository, Model $model)
    {
        $this->repository = $repository;
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function getAction()
    {
        return $this->action;
    }
}