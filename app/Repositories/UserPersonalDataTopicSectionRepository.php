<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTopicSection;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTopicSectionRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:46 pm UTC
 *
 * @method UserPersonalDataTopicSection findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTopicSection find($id, $columns = ['*'])
 * @method UserPersonalDataTopicSection first($columns = ['*'])
*/
class UserPersonalDataTopicSectionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'description',
        'status',
        'permissions',
        'user_id',
        'personal_data_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTopicSection::class;
    }
}
