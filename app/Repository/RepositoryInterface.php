<?php
/**
 * 功能：
 *
 * @project     wemesh
 * @author      Partoo
 * @copyright   2018 StarIO Network Technology Company
 * @link        http://www.stario.net
 */

namespace App\Repository;


interface RepositoryInterface
{
    /** 使用id进行查找
     * @param $id
     * @return mixed
     */
    public function find($id);

    /** 获取特定字段的特定值数据
     * 如$user->findBy('mobile', '18669683161') 会获得相应的数据
     * 同时也可以用来判断是否存在该数据
     * @param $field
     * @param null $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($field, $value = null, $columns = ['*']);

    /** 使用多个条件查询记录
     *  where格式如：['state_id'=>'10', 'country_id'=>'15', ['other', '>', '5']]
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere(array $where, $columns = ['*']);

    /** 参考Laravel WhereIn
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     */
    public function findWhereIn($field, array $values, $columns = ['*']);

    public function findWhereNotIn($field, array $values, $columns = ['*']);

    /**
     * 返回model
     * @return mixed
     */
    public function get();

    /** 同 Laravel pluck
     * @param $column
     * @param null $key
     * @return mixed
     */
    public function pluck($column, $key = null);

    /** 获取一个指定字段的值
     * @param $column
     * @param $value
     * @return mixed
     */
    public function pick($column, $value);

    /** 同步多对多关系中间表，不在ids数组中的会从中间表中删除(执行了detach)
     * @param $id
     * @param $relationTableName
     * @param array $ids
     * @return mixed
     */
    public function sync($id, $relationTableName, array $ids);

    /** 同步中间表，但不执行detach(不在ids中的数组不会从中间表删除)
     * @param $id
     * @param $relationTableName
     * @param $ids
     * @return mixed
     */
    public function syncWithoutDetaching($id, $relationTableName, array $ids);

    /**
     * 自动判定model格式，执行Laravel的all()或get()
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*']);

    public function first($columns = ['*']);

    public function firstOrNew(array $attributes = []);

    public function firstOrCreate(array $attributes = []);

    public function paginate($limit = null, $columns = ['*']);

    public function create(array $attributes);

    public function update($id, $input);

    public function updateColumns($id, array $columns);

    public function delete($id);

    public function deleteWhere(array $where);

    public function with(array $relations);

    public function has($relation);

    public function withCount($relations);

    public function where($column, $operator, $value);

    public function orWhere($column, $operator, $value);

    public function whereHas($relation, $closure);

    public function getFieldsSearchable();

    /**
     * 生成友好的数据表格源
     * @param array|null $relation
     * @return mixed
     */
    public function dataTableProvider(array $relation = null);

    public function orderBy($column, $direction = 'asc');
}