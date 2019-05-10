<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:53 pm UTC
 *
 * @method PersonalDataTopicDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicDelete find($id, $columns = ['*'])
 * @method PersonalDataTopicDelete first($columns = ['*'])
*/
class PersonalDataTopicDeleteRepository extends BaseRepository
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
        return PersonalDataTopicDelete::class;
    }
}
