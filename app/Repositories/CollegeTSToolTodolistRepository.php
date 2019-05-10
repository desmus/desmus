<?php

namespace App\Repositories;

use App\Models\CollegeTSToolTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:35 am UTC
 *
 * @method CollegeTSToolTodolist findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolTodolist find($id, $columns = ['*'])
 * @method CollegeTSToolTodolist first($columns = ['*'])
*/
class CollegeTSToolTodolistRepository extends BaseRepository
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
        'c_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolTodolist::class;
    }
}
