<?php

namespace App\Repositories;

use App\Models\ProjectTSToolTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method ProjectTSToolTodolistView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolTodolistView find($id, $columns = ['*'])
 * @method ProjectTSToolTodolistView first($columns = ['*'])
*/
class ProjectTSToolTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolTodolistView::class;
    }
}
