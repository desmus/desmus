<?php

namespace App\Repositories;

use App\Models\JobTSToolFileDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolFileDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:56 pm UTC
 *
 * @method JobTSToolFileDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolFileDelete find($id, $columns = ['*'])
 * @method JobTSToolFileDelete first($columns = ['*'])
*/
class JobTSToolFileDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_t_s_t_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolFileDelete::class;
    }
}
