<?php

namespace App\Repositories;

use App\Models\CollegeTSNoteTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSNoteTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method CollegeTSNoteTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSNoteTodolistCreate find($id, $columns = ['*'])
 * @method CollegeTSNoteTodolistCreate first($columns = ['*'])
*/
class CollegeTSNoteTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_n_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSNoteTodolistCreate::class;
    }
}
