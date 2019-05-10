<?php

namespace App\Repositories;

use App\Models\JobTopicSectionTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicSectionTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method JobTopicSectionTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTopicSectionTodolistCreate find($id, $columns = ['*'])
 * @method JobTopicSectionTodolistCreate first($columns = ['*'])
*/
class JobTopicSectionTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicSectionTodolistCreate::class;
    }
}
