<?php

namespace App\Repositories;

use App\Models\JobTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method JobTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTodolistUpdate find($id, $columns = ['*'])
 * @method JobTodolistUpdate first($columns = ['*'])
*/
class JobTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTodolistUpdate::class;
    }
}
