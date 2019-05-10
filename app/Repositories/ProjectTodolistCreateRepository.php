<?php

namespace App\Repositories;

use App\Models\ProjectTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:07 am UTC
 *
 * @method ProjectTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTodolistCreate find($id, $columns = ['*'])
 * @method ProjectTodolistCreate first($columns = ['*'])
*/
class ProjectTodolistCreateRepository extends BaseRepository
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
        return ProjectTodolistCreate::class;
    }
}
