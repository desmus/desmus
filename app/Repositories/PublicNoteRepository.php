<?php

namespace App\Repositories;

use App\Models\PublicNote;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PublicNoteRepository
 * @package App\Repositories
 * @version December 19, 2018, 5:22 pm UTC
 *
 * @method PublicNote findWithoutFail($id, $columns = ['*'])
 * @method PublicNote find($id, $columns = ['*'])
 * @method PublicNote first($columns = ['*'])
*/
class PublicNoteRepository extends BaseRepository
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
        return PublicNote::class;
    }
}
