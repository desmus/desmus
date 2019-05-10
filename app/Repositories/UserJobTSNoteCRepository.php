<?php

namespace App\Repositories;

use App\Models\UserJobTSNoteC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSNoteCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:54 pm UTC
 *
 * @method UserJobTSNoteC findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSNoteC find($id, $columns = ['*'])
 * @method UserJobTSNoteC first($columns = ['*'])
*/
class UserJobTSNoteCRepository extends BaseRepository
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
        return UserJobTSNoteC::class;
    }
}
