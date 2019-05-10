<?php

namespace App\Repositories;

use App\Models\JobTSToolTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method JobTSToolTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolTodolistUpdate find($id, $columns = ['*'])
 * @method JobTSToolTodolistUpdate first($columns = ['*'])
*/
class JobTSToolTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolTodolistUpdate::class;
    }
}
