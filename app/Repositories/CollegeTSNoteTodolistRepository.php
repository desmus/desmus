<?php

namespace App\Repositories;

use App\Models\CollegeTSNoteTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSNoteTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:34 am UTC
 *
 * @method CollegeTSNoteTodolist findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSNoteTodolist find($id, $columns = ['*'])
 * @method CollegeTSNoteTodolist first($columns = ['*'])
*/
class CollegeTSNoteTodolistRepository extends BaseRepository
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
        'c_t_s_n_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSNoteTodolist::class;
    }
}
