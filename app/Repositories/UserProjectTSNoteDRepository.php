<?php

namespace App\Repositories;

use App\Models\UserProjectTSNoteD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSNoteDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:04 pm UTC
 *
 * @method UserProjectTSNoteD findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSNoteD find($id, $columns = ['*'])
 * @method UserProjectTSNoteD first($columns = ['*'])
*/
class UserProjectTSNoteDRepository extends BaseRepository
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
        return UserProjectTSNoteD::class;
    }
}
