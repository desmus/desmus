<?php

namespace App\Repositories;

use App\Models\MessageDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MessageDeleteRepository
 * @package App\Repositories
 * @version May 28, 2018, 5:22 pm UTC
 *
 * @method MessageDelete findWithoutFail($id, $columns = ['*'])
 * @method MessageDelete find($id, $columns = ['*'])
 * @method MessageDelete first($columns = ['*'])
*/
class MessageDeleteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'message_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MessageDelete::class;
    }
}
