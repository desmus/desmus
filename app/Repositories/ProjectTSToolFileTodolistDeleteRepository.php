<?php

namespace App\Repositories;

use App\Models\ProjectTSToolFileTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolFileTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:17 am UTC
 *
 * @method ProjectTSToolFileTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolFileTodolistDelete find($id, $columns = ['*'])
 * @method ProjectTSToolFileTodolistDelete first($columns = ['*'])
*/
class ProjectTSToolFileTodolistDeleteRepository extends BaseRepository
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
        return ProjectTSToolFileTodolistDelete::class;
    }
}
