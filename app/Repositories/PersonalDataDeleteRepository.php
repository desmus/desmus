<?php

namespace App\Repositories;

use App\Models\PersonalDataDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:53 pm UTC
 *
 * @method PersonalDataDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataDelete find($id, $columns = ['*'])
 * @method PersonalDataDelete first($columns = ['*'])
*/
class PersonalDataDeleteRepository extends BaseRepository
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
        return PersonalDataDelete::class;
    }
}
