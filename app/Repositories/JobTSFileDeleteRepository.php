<?php

namespace App\Repositories;

use App\Models\JobTSFileDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSFileDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:54 pm UTC
 *
 * @method JobTSFileDelete findWithoutFail($id, $columns = ['*'])
 * @method JobTSFileDelete find($id, $columns = ['*'])
 * @method JobTSFileDelete first($columns = ['*'])
*/
class JobTSFileDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSFileDelete::class;
    }
}
