<?php

namespace App\Repositories;

use App\Models\JobTopic;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method JobTopic findWithoutFail($id, $columns = ['*'])
 * @method JobTopic find($id, $columns = ['*'])
 * @method JobTopic first($columns = ['*'])
*/
class JobTopicRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'specific_info',
        'views_quantity',
        'updates_quantity',
        'status',
        'job_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopic::class;
    }
}
