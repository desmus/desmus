<?php

namespace App\Repositories;

use App\Models\ProjectTopicTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:07 am UTC
 *
 * @method ProjectTopicTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicTodolistCreate find($id, $columns = ['*'])
 * @method ProjectTopicTodolistCreate first($columns = ['*'])
*/
class ProjectTopicTodolistCreateRepository extends BaseRepository
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
        return ProjectTopicTodolistCreate::class;
    }
}
