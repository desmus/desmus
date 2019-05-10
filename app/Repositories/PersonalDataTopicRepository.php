<?php

namespace App\Repositories;

use App\Models\PersonalDataTopic;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method PersonalDataTopic findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopic find($id, $columns = ['*'])
 * @method PersonalDataTopic first($columns = ['*'])
*/
class PersonalDataTopicRepository extends BaseRepository
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
        'personal_data_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopic::class;
    }
}
