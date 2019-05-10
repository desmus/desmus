<?php

namespace App\Repositories;

use App\Models\JobTSToolFileTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolFileTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:13 am UTC
 *
 * @method JobTSToolFileTodolistView findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolFileTodolistView find($id, $columns = ['*'])
 * @method JobTSToolFileTodolistView first($columns = ['*'])
*/
class JobTSToolFileTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_t_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolFileTodolistView::class;
    }
}
