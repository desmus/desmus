<?php

namespace App\Repositories;

use App\Models\CollegeTSFileTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSFileTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:11 am UTC
 *
 * @method CollegeTSFileTodolistView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSFileTodolistView find($id, $columns = ['*'])
 * @method CollegeTSFileTodolistView first($columns = ['*'])
*/
class CollegeTSFileTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'c_t_s_f_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSFileTodolistView::class;
    }
}
