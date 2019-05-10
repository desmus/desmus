<?php

namespace App\Repositories;

use App\Models\JobTSFileTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSFileTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method JobTSFileTodolistView findWithoutFail($id, $columns = ['*'])
 * @method JobTSFileTodolistView find($id, $columns = ['*'])
 * @method JobTSFileTodolistView first($columns = ['*'])
*/
class JobTSFileTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSFileTodolistView::class;
    }
}
