<?php

namespace App\Repositories;

use App\Models\JobTSToolFileCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolFileCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method JobTSToolFileCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolFileCreate find($id, $columns = ['*'])
 * @method JobTSToolFileCreate first($columns = ['*'])
*/
class JobTSToolFileCreateRepository extends BaseRepository
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
        return JobTSToolFileCreate::class;
    }
}
