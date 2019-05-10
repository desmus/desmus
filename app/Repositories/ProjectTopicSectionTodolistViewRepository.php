<?php

namespace App\Repositories;

use App\Models\ProjectTopicSectionTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicSectionTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method ProjectTopicSectionTodolistView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicSectionTodolistView find($id, $columns = ['*'])
 * @method ProjectTopicSectionTodolistView first($columns = ['*'])
*/
class ProjectTopicSectionTodolistViewRepository extends BaseRepository
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
        return ProjectTopicSectionTodolistView::class;
    }
}
