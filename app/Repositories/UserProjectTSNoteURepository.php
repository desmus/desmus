<?php

namespace App\Repositories;

use App\Models\UserProjectTSNoteU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSNoteURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:00 pm UTC
 *
 * @method UserProjectTSNoteU findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSNoteU find($id, $columns = ['*'])
 * @method UserProjectTSNoteU first($columns = ['*'])
*/
class UserProjectTSNoteURepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_p_t_s_n_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserProjectTSNoteU::class;
    }
}
