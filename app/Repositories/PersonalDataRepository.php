<?php

namespace App\Repositories;

use App\Models\PersonalData;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:45 pm UTC
 *
 * @method PersonalData findWithoutFail($id, $columns = ['*'])
 * @method PersonalData find($id, $columns = ['*'])
 * @method PersonalData first($columns = ['*'])
*/
class PersonalDataRepository extends BaseRepository
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
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalData::class;
    }
}
