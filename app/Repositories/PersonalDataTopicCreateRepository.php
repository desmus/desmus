<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method PersonalDataTopicCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicCreate find($id, $columns = ['*'])
 * @method PersonalDataTopicCreate first($columns = ['*'])
*/
class PersonalDataTopicCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicCreate::class;
    }
}
