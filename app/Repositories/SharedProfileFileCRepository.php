<?php

namespace App\Repositories;

use App\Models\SharedProfileFileC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileFileCRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileFileC findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileFileC find($id, $columns = ['*'])
 * @method SharedProfileFileC first($columns = ['*'])
*/
class SharedProfileFileCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        's_p_f_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileFileC::class;
    }
}
