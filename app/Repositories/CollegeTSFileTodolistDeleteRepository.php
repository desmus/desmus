<?php

namespace App\Repositories;

use App\Models\CollegeTSFileTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSFileTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:16 am UTC
 *
 * @method CollegeTSFileTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSFileTodolistDelete find($id, $columns = ['*'])
 * @method CollegeTSFileTodolistDelete first($columns = ['*'])
*/
class CollegeTSFileTodolistDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSFileTodolistDelete::class;
    }
}
