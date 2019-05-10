<?php

namespace App\Repositories;

use App\Models\CollegeTSToolTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method CollegeTSToolTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolTodolistCreate find($id, $columns = ['*'])
 * @method CollegeTSToolTodolistCreate first($columns = ['*'])
*/
class CollegeTSToolTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolTodolistCreate::class;
    }
}
