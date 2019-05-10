<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:48 pm UTC
 *
 * @method PersonalDataTSToolCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolCreate find($id, $columns = ['*'])
 * @method PersonalDataTSToolCreate first($columns = ['*'])
*/
class PersonalDataTSToolCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'personal_data_t_s_tool_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolCreate::class;
    }
}
