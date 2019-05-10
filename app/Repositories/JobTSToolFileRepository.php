<?php

namespace App\Repositories;

use App\Models\JobTSToolFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method JobTSToolFile findWithoutFail($id, $columns = ['*'])
 * @method JobTSToolFile find($id, $columns = ['*'])
 * @method JobTSToolFile first($columns = ['*'])
*/
class JobTSToolFileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'file_type',
        'views_quantity',
        'updates_quantity',
        'status',
        'job_t_s_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSToolFile::class;
    }
}
