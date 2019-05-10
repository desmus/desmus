<?php

namespace App\Repositories;

use App\Models\CollegeTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:10 am UTC
 *
 * @method CollegeTodolistView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTodolistView find($id, $columns = ['*'])
 * @method CollegeTodolistView first($columns = ['*'])
*/
class CollegeTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTodolistView::class;
    }
}
