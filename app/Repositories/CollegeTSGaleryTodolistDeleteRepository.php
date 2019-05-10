<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method CollegeTSGaleryTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryTodolistDelete find($id, $columns = ['*'])
 * @method CollegeTSGaleryTodolistDelete first($columns = ['*'])
*/
class CollegeTSGaleryTodolistDeleteRepository extends BaseRepository
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
        return CollegeTSGaleryTodolistDelete::class;
    }
}
