<?php

namespace App\Repositories;

use App\Models\CollegeTSGaleryTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGaleryTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method CollegeTSGaleryTodolistView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGaleryTodolistView find($id, $columns = ['*'])
 * @method CollegeTSGaleryTodolistView first($columns = ['*'])
*/
class CollegeTSGaleryTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_g_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGaleryTodolistView::class;
    }
}
