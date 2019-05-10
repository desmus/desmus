<?php

namespace App\Repositories;

use App\Models\ProjectTSNoteTodolistView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSNoteTodolistViewRepository
 * @package App\Repositories
 * @version May 30, 2018, 3:12 am UTC
 *
 * @method ProjectTSNoteTodolistView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSNoteTodolistView find($id, $columns = ['*'])
 * @method ProjectTSNoteTodolistView first($columns = ['*'])
*/
class ProjectTSNoteTodolistViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_t_s_n_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSNoteTodolistView::class;
    }
}
