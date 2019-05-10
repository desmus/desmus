<?php

namespace App\Repositories;

use App\Models\ProjectTSFileTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSFileTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method ProjectTSFileTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSFileTodolistUpdate find($id, $columns = ['*'])
 * @method ProjectTSFileTodolistUpdate first($columns = ['*'])
*/
class ProjectTSFileTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_t_s_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSFileTodolistUpdate::class;
    }
}
