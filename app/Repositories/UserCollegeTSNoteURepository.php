<?php

namespace App\Repositories;

use App\Models\UserCollegeTSNoteU;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCollegeTSNoteURepository
 * @package App\Repositories
 * @version June 18, 2018, 9:00 pm UTC
 *
 * @method UserCollegeTSNoteU findWithoutFail($id, $columns = ['*'])
 * @method UserCollegeTSNoteU find($id, $columns = ['*'])
 * @method UserCollegeTSNoteU first($columns = ['*'])
*/
class UserCollegeTSNoteURepository extends BaseRepository
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
        return UserCollegeTSNoteU::class;
    }
}
