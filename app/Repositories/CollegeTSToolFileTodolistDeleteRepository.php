<?php

namespace App\Repositories;

use App\Models\CollegeTSToolFileTodolistDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolFileTodolistDeleteRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:17 am UTC
 *
 * @method CollegeTSToolFileTodolistDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolFileTodolistDelete find($id, $columns = ['*'])
 * @method CollegeTSToolFileTodolistDelete first($columns = ['*'])
*/
class CollegeTSToolFileTodolistDeleteRepository extends BaseRepository
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
        return CollegeTSToolFileTodolistDelete::class;
    }
}
