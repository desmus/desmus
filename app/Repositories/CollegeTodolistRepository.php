<?php

namespace App\Repositories;

use App\Models\CollegeTodolist;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTodolistRepository
 * @package App\Repositories
 * @version May 29, 2018, 2:33 am UTC
 *
 * @method CollegeTodolist findWithoutFail($id, $columns = ['*'])
 * @method CollegeTodolist find($id, $columns = ['*'])
 * @method CollegeTodolist first($columns = ['*'])
*/
class CollegeTodolistRepository extends BaseRepository
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
        'college_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTodolist::class;
    }
}
