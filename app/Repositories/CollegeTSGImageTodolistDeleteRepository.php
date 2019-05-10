<?php

namespace App\Repositories;

use App\Models\CollegeTSGImageTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGImageTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method CollegeTSGImageTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGImageTodolistDelete find($id, $columns = ['*'])
 * @method CollegeTSGImageTodolistDelete first($columns = ['*'])
*/
class CollegeTSGImageTodolistDeleteRepository extends BaseRepository
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
        return CollegeTSGImageTodolistDelete::class;
    }
}
