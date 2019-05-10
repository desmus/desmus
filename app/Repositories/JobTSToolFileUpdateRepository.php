<?php

namespace App\Repositories;

use App\Models\JobTSToolFileUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolFileUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:52 pm UTC
 *
 * @method JobTSToolFileUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolFileUpdate find($id, $columns = ['*'])
 * @method JobTSToolFileUpdate first($columns = ['*'])
*/
class JobTSToolFileUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'job_t_s_t_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolFileUpdate::class;
    }
}
