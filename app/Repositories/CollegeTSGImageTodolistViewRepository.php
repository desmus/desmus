<?php

namespace App\Repositories;

use App\Models\CollegeTSGImageTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGImageTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method CollegeTSGImageTodolistView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGImageTodolistView find($id, $columns = ['*'])
 * @method CollegeTSGImageTodolistView first($columns = ['*'])
*/
class CollegeTSGImageTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_g_i_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGImageTodolistView::class;
    }
}
