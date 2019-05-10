<?php

namespace App\Repositories;

use App\Models\JobTSFile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSFileRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method JobTSFile findWithoutFail($id, $columns = ['*'])
 * @method JobTSFile find($id, $columns = ['*'])
 * @method JobTSFile first($columns = ['*'])
*/
class JobTSFileRepository extends BaseRepository
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
        'job_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTSFile::class;
    }
}
