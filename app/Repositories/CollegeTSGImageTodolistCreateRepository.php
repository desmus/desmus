<?php

namespace App\Repositories;

use App\Models\CollegeTSGImageTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGImageTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method CollegeTSGImageTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGImageTodolistCreate find($id, $columns = ['*'])
 * @method CollegeTSGImageTodolistCreate first($columns = ['*'])
*/
class CollegeTSGImageTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_g_i_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGImageTodolistCreate::class;
    }
}
