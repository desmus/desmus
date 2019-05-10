<?php

namespace App\Repositories;

use App\Models\CollegeTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:07 am UTC
 *
 * @method CollegeTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTodolistCreate find($id, $columns = ['*'])
 * @method CollegeTodolistCreate first($columns = ['*'])
*/
class CollegeTodolistCreateRepository extends BaseRepository
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
        return CollegeTodolistCreate::class;
    }
}
