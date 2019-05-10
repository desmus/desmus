<?php

namespace App\Repositories;

use App\Models\CollegeTSToolFileTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolFileTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:15 am UTC
 *
 * @method CollegeTSToolFileTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolFileTodolistUpdate find($id, $columns = ['*'])
 * @method CollegeTSToolFileTodolistUpdate first($columns = ['*'])
*/
class CollegeTSToolFileTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'c_t_s_t_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolFileTodolistUpdate::class;
    }
}
