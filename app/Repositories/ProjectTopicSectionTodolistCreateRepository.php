<?php

namespace App\Repositories;

use App\Models\ProjectTopicSectionTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicSectionTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method ProjectTopicSectionTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicSectionTodolistCreate find($id, $columns = ['*'])
 * @method ProjectTopicSectionTodolistCreate first($columns = ['*'])
*/
class ProjectTopicSectionTodolistCreateRepository extends BaseRepository
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
        return ProjectTopicSectionTodolistCreate::class;
    }
}
