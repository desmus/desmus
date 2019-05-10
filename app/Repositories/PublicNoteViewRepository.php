<?php

namespace App\Repositories;

use App\Models\PublicNoteView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicNoteViewRepository
 * @package App\Repositories
 * @version January 20, 2019, 3:45 am UTC
 *
 * @method PublicNoteView findWithoutFail($id, $columns = ['*'])
 * @method PublicNoteView find($id, $columns = ['*'])
 * @method PublicNoteView first($columns = ['*'])
*/
class PublicNoteViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'public_note_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PublicNoteView::class;
    }
}
