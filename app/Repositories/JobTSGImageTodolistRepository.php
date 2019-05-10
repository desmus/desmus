<?php

namespace App\Repositories;

use App\Models\JobTSGImageTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGImageTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method JobTSGImageTodolist findWithoutFail($id, $columns = ['*'])
 * @method JobTSGImageTodolist find($id, $columns = ['*'])
 * @method JobTSGImageTodolist first($columns = ['*'])
*/
class JobTSGImageTodolistRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'views_quantity',
        'updates_quantity',
        'status',
        'datetime',
        'j_t_s_g_i_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGImageTodolist::class;
    }
}
