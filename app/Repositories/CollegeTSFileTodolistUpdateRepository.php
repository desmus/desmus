<?php

namespace App\Repositories;

use App\Models\CollegeTSFileTodolistUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSFileTodolistUpdateRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:14 am UTC
 *
 * @method CollegeTSFileTodolistUpdate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSFileTodolistUpdate find($id, $columns = ['*'])
 * @method CollegeTSFileTodolistUpdate first($columns = ['*'])
*/
class CollegeTSFileTodolistUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'c_t_s_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSFileTodolistUpdate::class;
    }
}
