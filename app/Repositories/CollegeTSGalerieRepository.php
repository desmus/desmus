<?php

namespace App\Repositories;

use App\Models\CollegeTSGalerie;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSGalerieRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method CollegeTSGalerie findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSGalerie find($id, $columns = ['*'])
 * @method CollegeTSGalerie first($columns = ['*'])
*/
class CollegeTSGalerieRepository extends BaseRepository
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
        'college_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CollegeTSGalerie::class;
    }
}
