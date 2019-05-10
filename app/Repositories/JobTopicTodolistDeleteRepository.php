<?php

namespace App\Repositories;

use App\Models\JobTopicTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method JobTopicTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTopicTodolistDelete find($id, $columns = ['*'])
 * @method JobTopicTodolistDelete first($columns = ['*'])
*/
class JobTopicTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicTodolistDelete::class;
    }
}
