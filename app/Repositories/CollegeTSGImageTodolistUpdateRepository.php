<?php

namespace App\Repositories;

use App\Models\CollegeTSGImageTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGImageTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method CollegeTSGImageTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGImageTodolistUpdate find($id, $columns = ['*'])
 * @method CollegeTSGImageTodolistUpdate first($columns = ['*'])
*/
class CollegeTSGImageTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'c_t_s_g_i_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGImageTodolistUpdate::class;
    }
}
