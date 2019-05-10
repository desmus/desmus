<?php

namespace App\Repositories;

use App\Models\CollegeTopicTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method CollegeTopicTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicTodolistUpdate find($id, $columns = ['*'])
 * @method CollegeTopicTodolistUpdate first($columns = ['*'])
*/
class CollegeTopicTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'c_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicTodolistUpdate::class;
    }
}
