<?php

namespace App\Repositories;

use App\Models\JobTopicSectionTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicSectionTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method JobTopicSectionTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTopicSectionTodolistDelete find($id, $columns = ['*'])
 * @method JobTopicSectionTodolistDelete first($columns = ['*'])
*/
class JobTopicSectionTodolistDeleteRepository extends BaseRepository
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
        return JobTopicSectionTodolistDelete::class;
    }
}
