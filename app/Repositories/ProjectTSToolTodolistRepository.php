<?php

namespace App\Repositories;

use App\Models\ProjectTSToolTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method ProjectTSToolTodolist findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolTodolist find($id, $columns = ['*'])
 * @method ProjectTSToolTodolist first($columns = ['*'])
*/
class ProjectTSToolTodolistRepository extends BaseRepository
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
        'p_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolTodolist::class;
    }
}
