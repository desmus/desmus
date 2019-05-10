<?php

namespace App\Repositories;

use App\Models\JobTopicTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method JobTopicTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTopicTodolistUpdate find($id, $columns = ['*'])
 * @method JobTopicTodolistUpdate first($columns = ['*'])
*/
class JobTopicTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicTodolistUpdate::class;
    }
}
