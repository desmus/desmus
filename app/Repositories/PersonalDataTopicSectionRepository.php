<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicSection;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicSectionRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method PersonalDataTopicSection findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicSection find($id, $columns = ['*'])
 * @method PersonalDataTopicSection first($columns = ['*'])
*/
class PersonalDataTopicSectionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'specific_info',
        'views_quantity',
        'updates_quantity',
        'status',
        'personal_data_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicSection::class;
    }
}
