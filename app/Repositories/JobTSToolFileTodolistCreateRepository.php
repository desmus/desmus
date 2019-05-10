<?php

namespace App\Repositories;

use App\Models\JobTSToolFileTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolFileTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method JobTSToolFileTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolFileTodolistCreate find($id, $columns = ['*'])
 * @method JobTSToolFileTodolistCreate first($columns = ['*'])
*/
class JobTSToolFileTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_t_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolFileTodolistCreate::class;
    }
}
