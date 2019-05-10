<?php

namespace App\Repositories;

use App\Models\CollegeTSToolFileTodolistCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolFileTodolistCreateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:09 am UTC
 *
 * @method CollegeTSToolFileTodolistCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolFileTodolistCreate find($id, $columns = ['*'])
 * @method CollegeTSToolFileTodolistCreate first($columns = ['*'])
*/
class CollegeTSToolFileTodolistCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_t_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolFileTodolistCreate::class;
    }
}
