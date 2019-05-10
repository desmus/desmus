<?php

namespace App\Repositories;

use App\Models\SharedProfileImageC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileImageCRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileImageC findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileImageC find($id, $columns = ['*'])
 * @method SharedProfileImageC first($columns = ['*'])
*/
class SharedProfileImageCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        's_p_i_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileImageC::class;
    }
}
