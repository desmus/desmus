<?php

namespace App\Repositories;

use App\Models\PublicNoteComment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicNoteCommentRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:23 pm UTC
 *
 * @method PublicNoteComment findWithoutFail($id, $columns = ['*'])
 * @method PublicNoteComment find($id, $columns = ['*'])
 * @method PublicNoteComment first($columns = ['*'])
*/
class PublicNoteCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        'public_note_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicNoteComment::class;
    }
}
