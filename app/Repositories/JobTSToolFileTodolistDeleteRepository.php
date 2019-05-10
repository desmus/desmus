<?php

namespace App\Repositories;

use App\Models\JobTSToolFileTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolFileTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:17 am UTC
 *
 * @method JobTSToolFileTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolFileTodolistDelete find($id, $columns = ['*'])
 * @method JobTSToolFileTodolistDelete first($columns = ['*'])
*/
class JobTSToolFileTodolistDeleteRepository extends BaseRepository
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
        return JobTSToolFileTodolistDelete::class;
    }
}
