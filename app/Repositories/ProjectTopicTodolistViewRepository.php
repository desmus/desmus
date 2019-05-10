<?php

namespace App\Repositories;

use App\Models\ProjectTopicTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method ProjectTopicTodolistView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicTodolistView find($id, $columns = ['*'])
 * @method ProjectTopicTodolistView first($columns = ['*'])
*/
class ProjectTopicTodolistViewRepository extends BaseRepository
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
        return ProjectTopicTodolistView::class;
    }
}
