<?php

namespace App\Repositories;

use App\Models\ProjectTopicSectionTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicSectionTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method ProjectTopicSectionTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicSectionTodolistUpdate find($id, $columns = ['*'])
 * @method ProjectTopicSectionTodolistUpdate first($columns = ['*'])
*/
class ProjectTopicSectionTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicSectionTodolistUpdate::class;
    }
}
