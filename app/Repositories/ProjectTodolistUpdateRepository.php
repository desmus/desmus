<?php

namespace App\Repositories;

use App\Models\ProjectTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method ProjectTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTodolistUpdate find($id, $columns = ['*'])
 * @method ProjectTodolistUpdate first($columns = ['*'])
*/
class ProjectTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTodolistUpdate::class;
    }
}
