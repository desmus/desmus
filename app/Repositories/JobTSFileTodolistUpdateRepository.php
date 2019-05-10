<?php

namespace App\Repositories;

use App\Models\JobTSFileTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSFileTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method JobTSFileTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSFileTodolistUpdate find($id, $columns = ['*'])
 * @method JobTSFileTodolistUpdate first($columns = ['*'])
*/
class JobTSFileTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_s_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSFileTodolistUpdate::class;
    }
}
