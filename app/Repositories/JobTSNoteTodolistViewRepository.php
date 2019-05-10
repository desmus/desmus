<?php

namespace App\Repositories;

use App\Models\JobTSNoteTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSNoteTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method JobTSNoteTodolistView findWithoutFail($id, $columns = ['*'])
 * @method JobTSNoteTodolistView find($id, $columns = ['*'])
 * @method JobTSNoteTodolistView first($columns = ['*'])
*/
class JobTSNoteTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'j_t_s_n_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSNoteTodolistView::class;
    }
}
