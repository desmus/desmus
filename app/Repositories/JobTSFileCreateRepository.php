<?php

namespace App\Repositories;

use App\Models\JobTSFileCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSFileCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method JobTSFileCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSFileCreate find($id, $columns = ['*'])
 * @method JobTSFileCreate first($columns = ['*'])
*/
class JobTSFileCreateRepository extends BaseRepository
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
        return JobTSFileCreate::class;
    }
}
