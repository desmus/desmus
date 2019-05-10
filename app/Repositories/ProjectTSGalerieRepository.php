<?php

namespace App\Repositories;

use App\Models\ProjectTSGalerie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ProjectTSGalerieRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method ProjectTSGalerie findWithoutFail($id, $columns = ['*'])
 * @method ProjectTSGalerie find($id, $columns = ['*'])
 * @method ProjectTSGalerie first($columns = ['*'])
*/
class ProjectTSGalerieRepository extends BaseRepository
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
        'project_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectTSGalerie::class;
    }
}
