<?php

namespace App\Repositories;

use App\Models\UserJobTSNoteU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserJobTSNoteURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:00 pm UTC
 *
 * @method UserJobTSNoteU findWithoutFail($id, $columns = ['*'])
 * @method UserJobTSNoteU find($id, $columns = ['*'])
 * @method UserJobTSNoteU first($columns = ['*'])
*/
class UserJobTSNoteURepository extends BaseRepository
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
        return UserJobTSNoteU::class;
    }
}
