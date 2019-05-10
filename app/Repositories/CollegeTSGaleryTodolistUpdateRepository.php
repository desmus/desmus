<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method CollegeTSGaleryTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryTodolistUpdate find($id, $columns = ['*'])
 * @method CollegeTSGaleryTodolistUpdate first($columns = ['*'])
*/
class CollegeTSGaleryTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'c_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGaleryTodolistUpdate::class;
    }
}
