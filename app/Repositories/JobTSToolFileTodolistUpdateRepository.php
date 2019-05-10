<?php

namespace App\Repositories;

use App\Models\JobTSToolFileTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolFileTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method JobTSToolFileTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolFileTodolistUpdate find($id, $columns = ['*'])
 * @method JobTSToolFileTodolistUpdate first($columns = ['*'])
*/
class JobTSToolFileTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_s_t_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolFileTodolistUpdate::class;
    }
}
