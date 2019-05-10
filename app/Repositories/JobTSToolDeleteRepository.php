<?php

namespace App\Repositories;

use App\Models\JobTSToolDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:55 pm UTC
 *
 * @method JobTSToolDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolDelete find($id, $columns = ['*'])
 * @method JobTSToolDelete first($columns = ['*'])
*/
class JobTSToolDeleteRepository extends BaseRepository
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
        return JobTSToolDelete::class;
    }
}
