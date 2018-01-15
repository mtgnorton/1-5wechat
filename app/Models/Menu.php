<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

/**
 * Class Menu.
 *
 * @property int $id
 *
 * @method where($parent_id, $id)
 */
class Menu extends Model
{
    use ModelTree, AdminBuilder;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'order', 'title' , 'uri'];

    protected $table = "wechat_menu";
    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable('wechat_menu');

        parent::__construct($attributes);
    }


    /**
     * @return array
     */
//    public function allNodes() : array
//    {
//        $orderColumn = DB::getQueryGrammar()->wrap($this->orderColumn);
//        $byOrder = $orderColumn.' = 0,'.$orderColumn;
//
//        return static::with('roles')->orderByRaw($byOrder)->get()->toArray();
//    }
}
