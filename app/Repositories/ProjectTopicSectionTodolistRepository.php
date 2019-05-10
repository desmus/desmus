<?php

namespace App\Repositories;

use App\Models\ProjectTopicSectionTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicSectionTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method ProjectTopicSectionTodolist findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicSectionTodolist find($id, $columns = ['*'])
 * @method ProjectTopicSectionTodolist first($columns = ['*'])
*/
class ProjectTopicSectionTodolistRepository extends BaseRepository
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
        'p_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicSectionTodolist::class;
    }
}
