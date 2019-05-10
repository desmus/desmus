<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicSectionCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicSectionCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method PersonalDataTopicSectionCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicSectionCreate find($id, $columns = ['*'])
 * @method PersonalDataTopicSectionCreate first($columns = ['*'])
*/
class PersonalDataTopicSectionCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_t_s_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTopicSectionCreate::class;
    }
}
