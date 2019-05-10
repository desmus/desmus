<?php

namespace App\Repositories;

use App\Models\JobTSToolTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method JobTSToolTodolist findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolTodolist find($id, $columns = ['*'])
 * @method JobTSToolTodolist first($columns = ['*'])
*/
class JobTSToolTodolistRepository extends BaseRepository
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
        'j_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolTodolist::class;
    }
}
