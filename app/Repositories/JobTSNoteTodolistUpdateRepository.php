<?php

namespace App\Repositories;

use App\Models\JobTSNoteTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSNoteTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method JobTSNoteTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSNoteTodolistUpdate find($id, $columns = ['*'])
 * @method JobTSNoteTodolistUpdate first($columns = ['*'])
*/
class JobTSNoteTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_s_n_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSNoteTodolistUpdate::class;
    }
}
