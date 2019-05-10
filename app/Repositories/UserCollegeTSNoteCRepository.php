<?php

namespace App\Repositories;

use App\Models\UserCollegeTSNoteC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSNoteCRepository
 * @package App\Repositories
 * @version June 18, 2018, 8:54 pm UTC
 *
 * @method UserCollegeTSNoteC findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSNoteC find($id, $columns = ['*'])
 * @method UserCollegeTSNoteC first($columns = ['*'])
*/
class UserCollegeTSNoteCRepository extends BaseRepository
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
        return UserCollegeTSNoteC::class;
    }
}
