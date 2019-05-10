<?php

namespace App\Repositories;

use App\Models\JobTopicTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:07 am UTC
 *
 * @method JobTopicTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTopicTodolistCreate find($id, $columns = ['*'])
 * @method JobTopicTodolistCreate first($columns = ['*'])
*/
class JobTopicTodolistCreateRepository extends BaseRepository
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
        return JobTopicTodolistCreate::class;
    }
}
