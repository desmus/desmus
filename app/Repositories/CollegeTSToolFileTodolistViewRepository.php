<?php

namespace App\Repositories;

use App\Models\CollegeTSToolFileTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolFileTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method CollegeTSToolFileTodolistView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolFileTodolistView find($id, $columns = ['*'])
 * @method CollegeTSToolFileTodolistView first($columns = ['*'])
*/
class CollegeTSToolFileTodolistViewRepository extends BaseRepository
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
        return CollegeTSToolFileTodolistView::class;
    }
}
