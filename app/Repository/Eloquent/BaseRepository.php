<?php

namespace App\Repository\Eloquent;

// use App\Events\RepoCreated;
// use App\Events\RepoDeleted;
// use App\Events\RepoUpdated;
use App\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * $this->model是一个Eloquent Builder
 * $this->model->get()则返回model类，如User类,Post类等
 */
abstract class BaseRepository implements RepositoryInterface
{
    protected $fieldSearchable = [];
    protected $model;
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        try {
            $this->makeModel();
        } catch (\Exception $e) {
        }

    }

    /**
     * 依据给定的key返回所有数值
     * @param $column
     * @param null $key
     * @return
     */
    public function pluck($column, $key = null)
    {
        return $this->model->pluck($column, $key);
    }

    /**
     * 同步多对多关系模型中间表，给定数组中的ID会保留在中间表中，不在的会从中间表中删除
     * 如 $user->roles()->sync([1, 2, 3]);
     * 如 $user->roles()->sync([1 => ['expires' => true], 2, 3]);
     * @param  $id
     * @param $relationTableName
     * @param array $ids
     * @return mixed
     */
    public function sync($id, $relationTableName, array $ids)
    {
        return $this->find($id)->{$relationTableName}()->sync($ids);
    }

    /**
     * 同步中间表，不删除不在给定数组的ID
     * @param  $id
     * @param $relationTableName
     * @param array $ids
     * @return
     */
    public function syncWithoutDetaching($id, $relationTableName, array $ids)
    {
        return $this->find($id)->{$relationTableName}()->syncWithoutDetaching($ids);
    }

    public function all($columns = ['*'])
    {
        $result = $this->model instanceof Builder ? $this->model->get($columns) : $this->model->all($columns);
        return $result;
    }

    /**
     * @param  array $columns
     * @return MODEL
     */
    public function first($columns = ['*'])
    {
        return $this->model->first($columns);
    }

    public function firstOrNew(array $attributes = [])
    {
        return $this->model->firstOrNew($attributes);
    }

    public function firstOrCreate(array $attributes = [])
    {
        return $this->model->firstOrCreate($attributes);
    }

    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? 15 : $limit;
        $result = $this->model->paginate($limit, $columns);
        $result->appends(app('request')->query());
        return $result;
    }

    /**
     * 使用id查找
     * @param $id
     * @return
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * 获取特定字段的特定值数据
     * 如$user->findBy('mobile', '18669683161') 会获得相应的数据
     * 同时也可以用来判断是否存在该数据
     * @param $field
     * @param null $value
     * @param array $columns
     * @return
     */
    public function findBy($field, $value = null, $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->get($columns);
    }

    /**
     * 多个条件来获取记录
     * @param  array $where 条件，如['state_id'=>'10', 'country_id'=>'15', ['other', '>', '5']]
     * @param  array $columns 取出的字段
     * @return Collection
     */
    public function findWhere(array $where, $columns = ['*'])
    {
        $this->applyConditions($where);
        return $this->model->get($columns);
    }

    /**
     * 检索结果在$values中的数据
     * @param  string $field 对比字段
     * @param  array $values 想要的结果
     * @param  array $columns 取出的字段
     * @return mixed
     */
    public function findWhereIn($field, array $values, $columns = ['*'])
    {
        return $this->model->whereIn($field, $values)->get($columns);
    }

    /**
     * 与上面相反
     * @param string $field
     * @param array $values
     * @param array $columns
     * @return
     */
    public function findWhereNotIn($field, array $values, $columns = ['*'])
    {
        return $this->model->whereNotIn($field, $values)->get($columns);
    }

    public function count()
    {
        return $this->model->count();
    }

    /**
     * 返回model
     * @return MODEL
     */
    public function get()
    {
        return $this->model->get();
    }

    /**
     * 获取与值匹配的模型
     * @param  string $column 字段名称
     * @param  string $value 要查询的字段值
     * @return MODEL
     */
    public function pick($column, $value)
    {
        return $this->model->where($column, $value)->first();
    }

    /**
     * 创建一个实体并触发事件
     * @param  array $attributes
     * @return Builder
     */
    public function create(array $attributes)
    {
        $model = $this->model->newInstance($attributes);
        $model->save();
        // event(new RepoCreated($model));
        return $model;
    }

    /**
     * 更新实体并触发事件
     */
    public function update($id, $input)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($input);
        $model->save();
        // event(new RepoUpdated($model));
        return $model;
    }

    /**
     * 同时更新多个字段
     */
    public function updateColumns($id, array $columns)
    {
        $this->model = $this->getById($id);
        foreach ($columns as $key => $value) {
            $this->model->{key} = $value;
        }
        return $this->model->save();
    }

    /**
     * TODO: 删除后给用户发送短信
     *  使用id检索删除指定实体
     */
    public function delete($id)
    {
        $model = $this->find($id);
        $deleted = $model->delete();
        // event(new RepoDeleted($model));
        return $deleted;
    }

    /**
     * 使用多个条件检索删除实体
     */
    public function deleteWhere(array $where)
    {
        $this->applyConditions($where);
        $deleted = $this->model->delete();
        // event(new RepoDeleted($model));
        return $deleted;
    }

    public function with(array $relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }

    /**
     * Check if entity has relation
     * @param string $relation
     * @return $this
     */
    public function has($relation)
    {
        $this->model = $this->model->has($relation);
        return $this;
    }

    /**
     * Add subselect queries to count the relations.
     * @param  mixed $relations
     * @return $this
     */
    public function withCount($relations)
    {
        $this->model = $this->model->withCount($relations);
        return $this;
    }

    /**
     * Load relation with closure
     * @param string $relation
     * @param closure $closure
     * @return $this
     */
    public function whereHas($relation, $closure)
    {
        $this->model = $this->model->whereHas($relation, $closure);
        return $this;
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

    public function where($column, $operator, $value)
    {
        return $this->model->where($column, $operator, $value);
    }

    public function orWhere($column, $operator, $value)
    {
        return $this->model->orWhere($column, $operator, $value);
    }

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * 生成VueTable数据源
     * request格式为
     * http://jd54.dev/api/user?sort=status|desc&page=1&per_page=15&filter=186
     */
    public function dataTableProvider(array $relation = null)
    {
        $fields = $this->getFieldsSearchable();
        $request = request();
        $perpage = $request['per_page'];
        $sorts = $request['sort'] == '' ? ['id', 'asc'] : explode('|', $request['sort']);
        $filter = $request['filter'];

        if ($relation == null) {
            $model = $this->orderBy($sorts[0], $sorts[1]);
        } else {
            $model = $this->with($relation)->orderBy($sorts[0], $sorts[1]);
        }
        if (!empty($filter)) {
            foreach ($fields as $k => $value) {
                if ($k == 0) {
                    $model->where($fields[$k], 'LIKE', "%$filter%");
                }
                $model->orWhere($fields[$k], 'LIKE', "%$filter%");
            }
        }
        return $model->paginate($perpage);
    }

    /**
     * Applies the given where conditions to the model.
     * example:
     * $this->user->findWhere([['mobile', '=', $data['mobile']]])->pluck('id');
     * @param array $where
     * @return void
     */
    protected function applyConditions(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }

    /**
     * @return Model
     * @throws RepositoryException
     * @throws \Exception
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }
}