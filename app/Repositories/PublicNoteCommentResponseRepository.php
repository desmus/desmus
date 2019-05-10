<?php

namespace App\Repositories;

use App\Models\PublicNoteCommentResponse;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicNoteCommentResponseRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:23 pm UTC
 *
 * @method PublicNoteCommentResponse findWithoutFail($id, $columns = ['*'])
 * @method PublicNoteCommentResponse find($id, $columns = ['*'])
 * @method PublicNoteCommentResponse first($columns = ['*'])
*/
class PublicNoteCommentResponseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'content',
        'status',
        'datetime',
        'public_note_comment_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicNoteCommentResponse::class;
    }
}
