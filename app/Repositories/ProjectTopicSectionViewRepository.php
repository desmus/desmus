<?php

namespace App\Repositories;

use App\Models\ProjectTopicSectionView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTopicSectionViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method ProjectTopicSectionView findWithoutFail($id, $columns = ['*'])
 * @method ProjectTopicSectionView find($id, $columns = ['*'])
 * @method ProjectTopicSectionView first($columns = ['*'])
*/
class ProjectTopicSectionViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'project_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTopicSectionView::class;
    }
}
