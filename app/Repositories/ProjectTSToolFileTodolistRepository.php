<?php

namespace App\Repositories;

use App\Models\ProjectTSToolFileTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolFileTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method ProjectTSToolFileTodolist findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolFileTodolist find($id, $columns = ['*'])
 * @method ProjectTSToolFileTodolist first($columns = ['*'])
*/
class ProjectTSToolFileTodolistRepository extends BaseRepository
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
        'p_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolFileTodolist::class;
    }
}
