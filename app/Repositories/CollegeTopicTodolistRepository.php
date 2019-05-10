<?php

namespace App\Repositories;

use App\Models\CollegeTopicTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method CollegeTopicTodolist findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicTodolist find($id, $columns = ['*'])
 * @method CollegeTopicTodolist first($columns = ['*'])
*/
class CollegeTopicTodolistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'views_quantity',
        'updates_quantity',
        'status',
        'datetime',
        'college_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicTodolist::class;
    }
}
