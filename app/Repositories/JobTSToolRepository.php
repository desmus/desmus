<?php

namespace App\Repositories;

use App\Models\JobTSTool;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSToolRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method JobTSTool findWithoutFail($id, $columns = ['*'])
 * @method JobTSTool find($id, $columns = ['*'])
 * @method JobTSTool first($columns = ['*'])
*/
class JobTSToolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
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
        return JobTSTool::class;
    }
}
