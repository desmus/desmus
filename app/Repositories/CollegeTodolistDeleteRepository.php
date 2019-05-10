<?php

namespace App\Repositories;

use App\Models\CollegeTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method CollegeTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTodolistDelete find($id, $columns = ['*'])
 * @method CollegeTodolistDelete first($columns = ['*'])
*/
class CollegeTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTodolistDelete::class;
    }
}
