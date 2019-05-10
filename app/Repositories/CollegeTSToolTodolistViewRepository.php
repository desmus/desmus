<?php

namespace App\Repositories;

use App\Models\CollegeTSToolTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method CollegeTSToolTodolistView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolTodolistView find($id, $columns = ['*'])
 * @method CollegeTSToolTodolistView first($columns = ['*'])
*/
class CollegeTSToolTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_t_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolTodolistView::class;
    }
}
