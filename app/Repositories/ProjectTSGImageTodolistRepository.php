<?php

namespace App\Repositories;

use App\Models\ProjectTSGImageTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGImageTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method ProjectTSGImageTodolist findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGImageTodolist find($id, $columns = ['*'])
 * @method ProjectTSGImageTodolist first($columns = ['*'])
*/
class ProjectTSGImageTodolistRepository extends BaseRepository
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
        'p_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGImageTodolist::class;
    }
}
