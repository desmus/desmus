<?php

namespace App\Repositories;

use App\Models\ProjectTopicSectionTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicSectionTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method ProjectTopicSectionTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicSectionTodolistDelete find($id, $columns = ['*'])
 * @method ProjectTopicSectionTodolistDelete first($columns = ['*'])
*/
class ProjectTopicSectionTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicSectionTodolistDelete::class;
    }
}
