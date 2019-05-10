<?php

namespace App\Repositories;

use App\Models\CollegeTSTool;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CollegeTSToolRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method CollegeTSTool findWithoutFail($id, $columns = ['*'])
 * @method CollegeTSTool find($id, $columns = ['*'])
 * @method CollegeTSTool first($columns = ['*'])
*/
class CollegeTSToolRepository extends BaseRepository
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
        return CollegeTSTool::class;
    }
}
