<?php

namespace App\Repositories;

use App\Models\CollegeTopicTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:07 am UTC
 *
 * @method CollegeTopicTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicTodolistCreate find($id, $columns = ['*'])
 * @method CollegeTopicTodolistCreate first($columns = ['*'])
*/
class CollegeTopicTodolistCreateRepository extends BaseRepository
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
        return CollegeTopicTodolistCreate::class;
    }
}
