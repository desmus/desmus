<?php

namespace App\Repositories;

use App\Models\ProjectTSToolFileTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSToolFileTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method ProjectTSToolFileTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSToolFileTodolistCreate find($id, $columns = ['*'])
 * @method ProjectTSToolFileTodolistCreate first($columns = ['*'])
*/
class ProjectTSToolFileTodolistCreateRepository extends BaseRepository
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
        return ProjectTSToolFileTodolistCreate::class;
    }
}
