<?php

namespace App\Repositories;

use App\Models\ProjectTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:33 am UTC
 *
 * @method ProjectTodolist findWithoutFail($id, $columns = ['*'])
 * @method ProjectTodolist find($id, $columns = ['*'])
 * @method ProjectTodolist first($columns = ['*'])
*/
class ProjectTodolistRepository extends BaseRepository
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
        'project_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTodolist::class;
    }
}
