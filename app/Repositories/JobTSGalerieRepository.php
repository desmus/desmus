<?php

namespace App\Repositories;

use App\Models\JobTSGalerie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class JobTSGalerieRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method JobTSGalerie findWithoutFail($id, $columns = ['*'])
 * @method JobTSGalerie find($id, $columns = ['*'])
 * @method JobTSGalerie first($columns = ['*'])
*/
class JobTSGalerieRepository extends BaseRepository
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
        return JobTSGalerie::class;
    }
}
