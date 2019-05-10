<?php

namespace App\Repositories;

use App\Models\JobTopicTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method JobTopicTodolist findWithoutFail($id, $columns = ['*'])
 * @method JobTopicTodolist find($id, $columns = ['*'])
 * @method JobTopicTodolist first($columns = ['*'])
*/
class JobTopicTodolistRepository extends BaseRepository
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
        'job_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicTodolist::class;
    }
}
