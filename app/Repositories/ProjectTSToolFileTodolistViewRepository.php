<?php

namespace App\Repositories;

use App\Models\ProjectTSToolFileTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolFileTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method ProjectTSToolFileTodolistView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolFileTodolistView find($id, $columns = ['*'])
 * @method ProjectTSToolFileTodolistView first($columns = ['*'])
*/
class ProjectTSToolFileTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_t_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolFileTodolistView::class;
    }
}
