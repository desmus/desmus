<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSNoteC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSNoteCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:54 pm UTC
 *
 * @method UserPersonalDataTSNoteC findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSNoteC find($id, $columns = ['*'])
 * @method UserPersonalDataTSNoteC first($columns = ['*'])
*/
class UserPersonalDataTSNoteCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'u_p_d_t_s_n_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPersonalDataTSNoteC::class;
    }
}
