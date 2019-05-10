<?php

namespace App\Repositories;

use App\Models\ProjectTSFileTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSFileTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method ProjectTSFileTodolist findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSFileTodolist find($id, $columns = ['*'])
 * @method ProjectTSFileTodolist first($columns = ['*'])
*/
class ProjectTSFileTodolistRepository extends BaseRepository
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
        'p_t_s_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSFileTodolist::class;
    }
}
