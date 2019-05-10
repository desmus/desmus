<?php

namespace App\Repositories;

use App\Models\PersonalDataCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:47 pm UTC
 *
 * @method PersonalDataCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataCreate find($id, $columns = ['*'])
 * @method PersonalDataCreate first($columns = ['*'])
*/
class PersonalDataCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataCreate::class;
    }
}
