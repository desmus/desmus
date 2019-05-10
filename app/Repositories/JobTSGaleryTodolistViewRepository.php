<?php

namespace App\Repositories;

use App\Models\JobTSGaleryTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGaleryTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method JobTSGaleryTodolistView findWithoutFail($id, $columns = ['*'])
 * @method JobTSGaleryTodolistView find($id, $columns = ['*'])
 * @method JobTSGaleryTodolistView first($columns = ['*'])
*/
class JobTSGaleryTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSGaleryTodolistView::class;
    }
}
