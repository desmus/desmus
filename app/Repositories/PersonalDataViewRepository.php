<?php

namespace App\Repositories;

use App\Models\PersonalDataView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataViewRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method PersonalDataView findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataView find($id, $columns = ['*'])
 * @method PersonalDataView first($columns = ['*'])
*/
class PersonalDataViewRepository extends BaseRepository
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
        return PersonalDataView::class;
    }
}
