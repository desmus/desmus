<?php

namespace App\Repositories;

use App\Models\CollegeTSNoteTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSNoteTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method CollegeTSNoteTodolistView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSNoteTodolistView find($id, $columns = ['*'])
 * @method CollegeTSNoteTodolistView first($columns = ['*'])
*/
class CollegeTSNoteTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_n_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSNoteTodolistView::class;
    }
}
