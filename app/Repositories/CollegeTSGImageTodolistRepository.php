<?php

namespace App\Repositories;

use App\Models\CollegeTSGImageTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGImageTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method CollegeTSGImageTodolist findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGImageTodolist find($id, $columns = ['*'])
 * @method CollegeTSGImageTodolist first($columns = ['*'])
*/
class CollegeTSGImageTodolistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'views_quantity',
        'updates_quantity',
        'status',
        'datetime',
        'c_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGImageTodolist::class;
    }
}
