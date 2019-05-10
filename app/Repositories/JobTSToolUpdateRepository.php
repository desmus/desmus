<?php

namespace App\Repositories;

use App\Models\JobTSToolUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method JobTSToolUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolUpdate find($id, $columns = ['*'])
 * @method JobTSToolUpdate first($columns = ['*'])
*/
class JobTSToolUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'job_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolUpdate::class;
    }
}
