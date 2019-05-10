<?php

namespace App\Repositories;

use App\Models\UserPersonalDataTSNoteU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserPersonalDataTSNoteURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:00 pm UTC
 *
 * @method UserPersonalDataTSNoteU findWithoutFail($id, $columns = ['*'])
 * @method UserPersonalDataTSNoteU find($id, $columns = ['*'])
 * @method UserPersonalDataTSNoteU first($columns = ['*'])
*/
class UserPersonalDataTSNoteURepository extends BaseRepository
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
        return UserPersonalDataTSNoteU::class;
    }
}
