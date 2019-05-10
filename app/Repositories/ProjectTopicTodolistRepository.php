<?php

namespace App\Repositories;

use App\Models\ProjectTopicTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method ProjectTopicTodolist findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicTodolist find($id, $columns = ['*'])
 * @method ProjectTopicTodolist first($columns = ['*'])
*/
class ProjectTopicTodolistRepository extends BaseRepository
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
        'project_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicTodolist::class;
    }
}
