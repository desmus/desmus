<?php

namespace App\Repositories;

use App\Models\ProjectTSGImageTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGImageTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method ProjectTSGImageTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGImageTodolistUpdate find($id, $columns = ['*'])
 * @method ProjectTSGImageTodolistUpdate first($columns = ['*'])
*/
class ProjectTSGImageTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_s_g_i_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGImageTodolistUpdate::class;
    }
}
