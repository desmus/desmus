<?php

namespace App\Repositories;

use App\Models\PersonalDataTSPTCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSPTCreateRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:36 am UTC
 *
 * @method PersonalDataTSPTCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSPTCreate find($id, $columns = ['*'])
 * @method PersonalDataTSPTCreate first($columns = ['*'])
*/
class PersonalDataTSPTCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_p_t_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSPTCreate::class;
    }
}
