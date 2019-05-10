<?php

namespace App\Repositories;

use App\Models\ProjectTSToolFileTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolFileTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method ProjectTSToolFileTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolFileTodolistUpdate find($id, $columns = ['*'])
 * @method ProjectTSToolFileTodolistUpdate first($columns = ['*'])
*/
class ProjectTSToolFileTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'p_t_s_t_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSToolFileTodolistUpdate::class;
    }
}
