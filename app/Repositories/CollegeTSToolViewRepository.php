<?php

namespace App\Repositories;

use App\Models\CollegeTSToolView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method CollegeTSToolView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSToolView find($id, $columns = ['*'])
 * @method CollegeTSToolView first($columns = ['*'])
*/
class CollegeTSToolViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSToolView::class;
    }
}
