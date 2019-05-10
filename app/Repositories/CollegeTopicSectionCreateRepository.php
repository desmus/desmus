<?php

namespace App\Repositories;

use App\Models\CollegeTopicSectionCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicSectionCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method CollegeTopicSectionCreate findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicSectionCreate find($id, $columns = ['*'])
 * @method CollegeTopicSectionCreate first($columns = ['*'])
*/
class CollegeTopicSectionCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'college_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTopicSectionCreate::class;
    }
}
