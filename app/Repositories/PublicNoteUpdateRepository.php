<?php

namespace App\Repositories;

use App\Models\PublicNoteUpdate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicNoteUpdateRepository
 * @package App\Repositories
 * @version January 19, 2019, 9:10 pm UTC
 *
 * @method PublicNoteUpdate findWithoutFail($id, $columns = ['*'])
 * @method PublicNoteUpdate find($id, $columns = ['*'])
 * @method PublicNoteUpdate first($columns = ['*'])
*/
class PublicNoteUpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'actual_name',
        'past_name',
        'datetime',
        'user_id',
        'public_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicNoteUpdate::class;
    }
}
