<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method CollegeTSGaleryTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryTodolistCreate find($id, $columns = ['*'])
 * @method CollegeTSGaleryTodolistCreate first($columns = ['*'])
*/
class CollegeTSGaleryTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGaleryTodolistCreate::class;
    }
}
