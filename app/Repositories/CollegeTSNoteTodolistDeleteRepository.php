<?php

namespace App\Repositories;

use App\Models\CollegeTSNoteTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSNoteTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method CollegeTSNoteTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSNoteTodolistDelete find($id, $columns = ['*'])
 * @method CollegeTSNoteTodolistDelete first($columns = ['*'])
*/
class CollegeTSNoteTodolistDeleteRepository extends BaseRepository
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
        return CollegeTSNoteTodolistDelete::class;
    }
}
