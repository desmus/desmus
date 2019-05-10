<?php

namespace App\Repositories;

use App\Models\SharedProfileNote;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SharedProfileNoteRepository
 * @package App\Repositories
 * @version April 11, 2019, 3:27 pm UTC
 *
 * @method SharedProfileNote findWithoutFail($id, $columns = ['*'])
 * @method SharedProfileNote find($id, $columns = ['*'])
 * @method SharedProfileNote first($columns = ['*'])
*/
class SharedProfileNoteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'content',
        'size',
        'views_quantity',
        'updates_quantity',
        'status',
        'datetime',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SharedProfileNote::class;
    }
}
