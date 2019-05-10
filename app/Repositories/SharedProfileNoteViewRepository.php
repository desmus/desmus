<?php

namespace App\Repositories;

use App\Models\SharedProfileNoteView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileNoteViewRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:29 pm UTC
 *
 * @method SharedProfileNoteView findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileNoteView find($id, $columns = ['*'])
 * @method SharedProfileNoteView first($columns = ['*'])
*/
class SharedProfileNoteViewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        's_p_n_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileNoteView::class;
    }
}
