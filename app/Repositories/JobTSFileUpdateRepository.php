<?php

namespace App\Repositories;

use App\Models\JobTSFileUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSFileUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method JobTSFileUpdate findWithoutFail($id, $columns = ['*'])
 * @method JobTSFileUpdate find($id, $columns = ['*'])
 * @method JobTSFileUpdate first($columns = ['*'])
*/
class JobTSFileUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'job_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSFileUpdate::class;
    }
}
