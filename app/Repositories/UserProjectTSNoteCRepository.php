<?php

namespace App\Repositories;

use App\Models\UserProjectTSNoteC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserProjectTSNoteCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:54 pm UTC
 *
 * @method UserProjectTSNoteC findWithoutFail($id, $columns = ['*'])
 * @method UserProjectTSNoteC find($id, $columns = ['*'])
 * @method UserProjectTSNoteC first($columns = ['*'])
*/
class UserProjectTSNoteCRepository extends BaseRepository
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
        return UserProjectTSNoteC::class;
    }
}
