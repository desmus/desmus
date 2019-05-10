<?php

namespace App\Repositories;

use App\Models\ProjectTSGImageTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGImageTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method ProjectTSGImageTodolistView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGImageTodolistView find($id, $columns = ['*'])
 * @method ProjectTSGImageTodolistView first($columns = ['*'])
*/
class ProjectTSGImageTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_g_i_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGImageTodolistView::class;
    }
}
