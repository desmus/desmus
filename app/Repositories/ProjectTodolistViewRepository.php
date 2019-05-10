<?php

namespace App\Repositories;

use App\Models\ProjectTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method ProjectTodolistView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTodolistView find($id, $columns = ['*'])
 * @method ProjectTodolistView first($columns = ['*'])
*/
class ProjectTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTodolistView::class;
    }
}
