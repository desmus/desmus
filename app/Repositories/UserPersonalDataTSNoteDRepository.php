<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSNoteD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSNoteDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:05 pm UTC
 *
 * @method UserPersonalDataTSNoteD findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSNoteD find($id, $columns = ['*'])
 * @method UserPersonalDataTSNoteD first($columns = ['*'])
*/
class UserPersonalDataTSNoteDRepository extends BaseRepository
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
        return UserPersonalDataTSNoteD::class;
    }
}
