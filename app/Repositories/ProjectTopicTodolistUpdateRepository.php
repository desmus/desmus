<?php

namespace App\Repositories;

use App\Models\ProjectTopicTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method ProjectTopicTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicTodolistUpdate find($id, $columns = ['*'])
 * @method ProjectTopicTodolistUpdate first($columns = ['*'])
*/
class ProjectTopicTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicTodolistUpdate::class;
    }
}
