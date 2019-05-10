<?php

namespace App\Repositories;

use App\Models\PersonalDataTSTool;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method PersonalDataTSTool findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSTool find($id, $columns = ['*'])
 * @method PersonalDataTSTool first($columns = ['*'])
*/
class PersonalDataTSToolRepository extends BaseRepository
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
        'personal_data_topic_section_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSTool::class;
    }
}
