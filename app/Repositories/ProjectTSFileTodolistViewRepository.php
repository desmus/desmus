<?php

namespace App\Repositories;

use App\Models\ProjectTSFileTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSFileTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method ProjectTSFileTodolistView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSFileTodolistView find($id, $columns = ['*'])
 * @method ProjectTSFileTodolistView first($columns = ['*'])
*/
class ProjectTSFileTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSFileTodolistView::class;
    }
}
