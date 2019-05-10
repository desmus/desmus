<?php

namespace App\Repositories;

use App\Models\ProjectTSPTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSPTodolistRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:35 am UTC
 *
 * @method ProjectTSPTodolist findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSPTodolist find($id, $columns = ['*'])
 * @method ProjectTSPTodolist first($columns = ['*'])
*/
class ProjectTSPTodolistRepository extends BaseRepository
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
        'p_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSPTodolist::class;
    }
}
