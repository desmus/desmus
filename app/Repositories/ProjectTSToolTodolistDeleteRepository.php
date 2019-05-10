<?php

namespace App\Repositories;

use App\Models\ProjectTSToolTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method ProjectTSToolTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolTodolistDelete find($id, $columns = ['*'])
 * @method ProjectTSToolTodolistDelete first($columns = ['*'])
*/
class ProjectTSToolTodolistDeleteRepository extends BaseRepository
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
        return ProjectTSToolTodolistDelete::class;
    }
}
