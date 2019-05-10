<?php

namespace App\Repositories;

use App\Models\JobTopicSectionView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTopicSectionViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method JobTopicSectionView findWithoutFail($id, $columns = ['*'])
 * @method JobTopicSectionView find($id, $columns = ['*'])
 * @method JobTopicSectionView first($columns = ['*'])
*/
class JobTopicSectionViewRepository extends BaseRepository
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
        return JobTopicSectionView::class;
    }
}
