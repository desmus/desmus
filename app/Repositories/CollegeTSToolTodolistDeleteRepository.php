<?php

namespace App\Repositories;

use App\Models\CollegeTSToolTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method CollegeTSToolTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolTodolistDelete find($id, $columns = ['*'])
 * @method CollegeTSToolTodolistDelete first($columns = ['*'])
*/
class CollegeTSToolTodolistDeleteRepository extends BaseRepository
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
        return CollegeTSToolTodolistDelete::class;
    }
}
