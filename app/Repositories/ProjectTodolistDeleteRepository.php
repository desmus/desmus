<?php

namespace App\Repositories;

use App\Models\ProjectTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method ProjectTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTodolistDelete find($id, $columns = ['*'])
 * @method ProjectTodolistDelete first($columns = ['*'])
*/
class ProjectTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTodolistDelete::class;
    }
}
