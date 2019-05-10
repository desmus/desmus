<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method ProjectTSGaleryTodolist findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryTodolist find($id, $columns = ['*'])
 * @method ProjectTSGaleryTodolist first($columns = ['*'])
*/
class ProjectTSGaleryTodolistRepository extends BaseRepository
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
        'p_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryTodolist::class;
    }
}
