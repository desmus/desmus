<?php

namespace App\Repositories;

use App\Models\PersonalDataTSFileCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSFileCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method PersonalDataTSFileCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSFileCreate find($id, $columns = ['*'])
 * @method PersonalDataTSFileCreate first($columns = ['*'])
*/
class PersonalDataTSFileCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_t_s_file_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSFileCreate::class;
    }
}
