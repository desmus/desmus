<?php

namespace App\Repositories;

use App\Models\PersonalDataTSToolFileDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSToolFileDeleteRepository
 * @package App\Repositories
 * @version May 5, 2018, 10:56 pm UTC
 *
 * @method PersonalDataTSToolFileDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSToolFileDelete find($id, $columns = ['*'])
 * @method PersonalDataTSToolFileDelete first($columns = ['*'])
*/
class PersonalDataTSToolFileDeleteRepository extends BaseRepository
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
        return PersonalDataTSToolFileDelete::class;
    }
}
