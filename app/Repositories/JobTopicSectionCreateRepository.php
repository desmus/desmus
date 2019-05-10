<?php

namespace App\Repositories;

use App\Models\JobTopicSectionCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicSectionCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method JobTopicSectionCreate findWithoutFail($id, $columns = ['*'])
 * @method JobTopicSectionCreate find($id, $columns = ['*'])
 * @method JobTopicSectionCreate first($columns = ['*'])
*/
class JobTopicSectionCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'job_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return JobTopicSectionCreate::class;
    }
}
