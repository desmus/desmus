<?php

namespace App\Repositories;

use App\Models\CollegeTSFileTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSFileTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:08 am UTC
 *
 * @method CollegeTSFileTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSFileTodolistCreate find($id, $columns = ['*'])
 * @method CollegeTSFileTodolistCreate first($columns = ['*'])
*/
class CollegeTSFileTodolistCreateRepository extends BaseRepository
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
        return CollegeTSFileTodolistCreate::class;
    }
}
