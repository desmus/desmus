<?php

namespace App\Repositories;

use App\Models\SharedProfileNoteUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileNoteUpdateRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:29 pm UTC
 *
 * @method SharedProfileNoteUpdate findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileNoteUpdate find($id, $columns = ['*'])
 * @method SharedProfileNoteUpdate first($columns = ['*'])
*/
class SharedProfileNoteUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        's_p_n_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileNoteUpdate::class;
    }
}
