<?php

namespace App\Repositories;

use App\Models\SharedProfileNoteC;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileNoteCRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:28 pm UTC
 *
 * @method SharedProfileNoteC findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileNoteC find($id, $columns = ['*'])
 * @method SharedProfileNoteC first($columns = ['*'])
*/
class SharedProfileNoteCRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        's_p_n_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileNoteC::class;
    }
}
