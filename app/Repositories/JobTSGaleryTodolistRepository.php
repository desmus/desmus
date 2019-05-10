<?php

namespace App\Repositories;

use App\Models\JobTSGaleryTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method JobTSGaleryTodolist findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryTodolist find($id, $columns = ['*'])
 * @method JobTSGaleryTodolist first($columns = ['*'])
*/
class JobTSGaleryTodolistRepository extends BaseRepository
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
        'j_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGaleryTodolist::class;
    }
}
