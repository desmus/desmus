<?php

namespace App\Repositories;

use App\Models\ProjectTSToolTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method ProjectTSToolTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolTodolistUpdate find($id, $columns = ['*'])
 * @method ProjectTSToolTodolistUpdate first($columns = ['*'])
*/
class ProjectTSToolTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolTodolistUpdate::class;
    }
}
