<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicSectionUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicSectionUpdateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:51 pm UTC
 *
 * @method PersonalDataTopicSectionUpdate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicSectionUpdate find($id, $columns = ['*'])
 * @method PersonalDataTopicSectionUpdate first($columns = ['*'])
*/
class PersonalDataTopicSectionUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'personal_data_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicSectionUpdate::class;
    }
}
