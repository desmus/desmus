<?php

namespace App\Repositories;

use App\Models\JobTSToolView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:50 pm UTC
 *
 * @method JobTSToolView findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolView find($id, $columns = ['*'])
 * @method JobTSToolView first($columns = ['*'])
*/
class JobTSToolViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolView::class;
    }
}
