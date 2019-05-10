<?php

namespace App\Repositories;

use App\Models\ProjectTSToolTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method ProjectTSToolTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolTodolistCreate find($id, $columns = ['*'])
 * @method ProjectTSToolTodolistCreate first($columns = ['*'])
*/
class ProjectTSToolTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolTodolistCreate::class;
    }
}
