<?php

namespace App\Repositories;

use App\Models\CollegeTopicTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method CollegeTopicTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicTodolistDelete find($id, $columns = ['*'])
 * @method CollegeTopicTodolistDelete first($columns = ['*'])
*/
class CollegeTopicTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicTodolistDelete::class;
    }
}
