<?php

namespace App\Repositories;

use App\Models\PersonalDataTopicSectionDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTopicSectionDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:54 pm UTC
 *
 * @method PersonalDataTopicSectionDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTopicSectionDelete find($id, $columns = ['*'])
 * @method PersonalDataTopicSectionDelete first($columns = ['*'])
*/
class PersonalDataTopicSectionDeleteRepository extends BaseRepository
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
        return PersonalDataTopicSectionDelete::class;
    }
}
