<?php

namespace App\Repositories;

use App\Models\CollegeTopicSectionDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicSectionDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:53 pm UTC
 *
 * @method CollegeTopicSectionDelete findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicSectionDelete find($id, $columns = ['*'])
 * @method CollegeTopicSectionDelete first($columns = ['*'])
*/
class CollegeTopicSectionDeleteRepository extends BaseRepository
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
        return CollegeTopicSectionDelete::class;
    }
}
