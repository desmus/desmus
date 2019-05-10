<?php

namespace App\Repositories;

use App\Models\CollegeTopicSectionView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTopicSectionViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method CollegeTopicSectionView findWithoutFail($id, $columns = ['*'])
 * @method CollegeTopicSectionView find($id, $columns = ['*'])
 * @method CollegeTopicSectionView first($columns = ['*'])
*/
class CollegeTopicSectionViewRepository extends BaseRepository
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
        return CollegeTopicSectionView::class;
    }
}
