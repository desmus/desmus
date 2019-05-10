<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method PersonalDataTopicUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicUpdate find($id, $columns = ['*'])
 * @method PersonalDataTopicUpdate first($columns = ['*'])
*/
class PersonalDataTopicUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'personal_data_topic_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicUpdate::class;
    }
}
