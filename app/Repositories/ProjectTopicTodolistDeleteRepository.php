<?php

namespace App\Repositories;

use App\Models\ProjectTopicTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method ProjectTopicTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicTodolistDelete find($id, $columns = ['*'])
 * @method ProjectTopicTodolistDelete first($columns = ['*'])
*/
class ProjectTopicTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicTodolistDelete::class;
    }
}
