<?php

namespace App\Repositories;

use App\Models\ProjectTSGaleryTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGaleryTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method ProjectTSGaleryTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGaleryTodolistUpdate find($id, $columns = ['*'])
 * @method ProjectTSGaleryTodolistUpdate first($columns = ['*'])
*/
class ProjectTSGaleryTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGaleryTodolistUpdate::class;
    }
}
