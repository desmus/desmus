<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method CollegeTSGaleryTodolist findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryTodolist find($id, $columns = ['*'])
 * @method CollegeTSGaleryTodolist first($columns = ['*'])
*/
class CollegeTSGaleryTodolistRepository extends BaseRepository
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
        'c_t_s_g_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGaleryTodolist::class;
    }
}
