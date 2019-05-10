<?php

namespace App\Repositories;

use App\Models\JobTSGImageTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGImageTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method JobTSGImageTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSGImageTodolistUpdate find($id, $columns = ['*'])
 * @method JobTSGImageTodolistUpdate first($columns = ['*'])
*/
class JobTSGImageTodolistUpdateRepository extends BaseRepository
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
        return JobTSGImageTodolistUpdate::class;
    }
}
