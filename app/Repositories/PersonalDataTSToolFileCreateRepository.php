<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolFileCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolFileCreateRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:49 pm UTC
 *
 * @method PersonalDataTSToolFileCreate findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolFileCreate find($id, $columns = ['*'])
 * @method PersonalDataTSToolFileCreate first($columns = ['*'])
*/
class PersonalDataTSToolFileCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'p_d_t_s_t_f_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PersonalDataTSToolFileCreate::class;
    }
}
