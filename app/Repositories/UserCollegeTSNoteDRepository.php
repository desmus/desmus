<?php

namespace App\Repositories;

use App\Models\UserCollegeTSNoteD;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSNoteDRepository
 * @package App\Repositories
 * @version June 18, 2018, 9:04 pm UTC
 *
 * @method UserCollegeTSNoteD findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSNoteD find($id, $columns = ['*'])
 * @method UserCollegeTSNoteD first($columns = ['*'])
*/
class UserCollegeTSNoteDRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_t_s_n_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCollegeTSNoteD::class;
    }
}
