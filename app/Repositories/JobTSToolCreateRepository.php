<?php

namespace App\Repositories;

use App\Models\JobTSToolCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method JobTSToolCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolCreate find($id, $columns = ['*'])
 * @method JobTSToolCreate first($columns = ['*'])
*/
class JobTSToolCreateRepository extends BaseRepository
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
        return JobTSToolCreate::class;
    }
}
