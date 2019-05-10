<?php

namespace App\Repositories;

use App\Models\PersonalDataTSPTDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PersonalDataTSPTDeleteRepository
 * @package App\Repositories
 * @version July 2, 2018, 3:37 am UTC
 *
 * @method PersonalDataTSPTDelete findWithoutFail($id, $columns = ['*'])
 * @method PersonalDataTSPTDelete find($id, $columns = ['*'])
 * @method PersonalDataTSPTDelete first($columns = ['*'])
*/
class PersonalDataTSPTDeleteRepository extends BaseRepository
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
        return PersonalDataTSPTDelete::class;
    }
}
