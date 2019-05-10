<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method ProjectTSGaleryTodolistView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryTodolistView find($id, $columns = ['*'])
 * @method ProjectTSGaleryTodolistView first($columns = ['*'])
*/
class ProjectTSGaleryTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryTodolistView::class;
    }
}
