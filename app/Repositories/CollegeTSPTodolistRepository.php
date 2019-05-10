<?php

namespace App\Repositories;

use App\Models\CollegeTSPTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSPTodolistRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:34 am UTC
 *
 * @method CollegeTSPTodolist findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSPTodolist find($id, $columns = ['*'])
 * @method CollegeTSPTodolist first($columns = ['*'])
*/
class CollegeTSPTodolistRepository extends BaseRepository
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
        'c_t_s_p_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSPTodolist::class;
    }
}
