<?php

namespace App\Repositories;

use App\Models\JobTSGaleryTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method JobTSGaleryTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryTodolistUpdate find($id, $columns = ['*'])
 * @method JobTSGaleryTodolistUpdate first($columns = ['*'])
*/
class JobTSGaleryTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'j_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGaleryTodolistUpdate::class;
    }
}
