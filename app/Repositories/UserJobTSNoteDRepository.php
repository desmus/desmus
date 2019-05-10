<?php

namespace App\Repositories;

use App\Models\UserJobTSNoteD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSNoteDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:04 pm UTC
 *
 * @method UserJobTSNoteD findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSNoteD find($id, $columns = ['*'])
 * @method UserJobTSNoteD first($columns = ['*'])
*/
class UserJobTSNoteDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_j_t_s_n_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserJobTSNoteD::class;
    }
}
