<?php
/**
 * 功能：
 *
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace App\Repository\Eloquent;


class UserRepository extends BaseRepository
{
    public function model()
    {
        return "App\\User";
    }

    protected $fieldSearchable = [
        'name', 'mobile'
    ];
}