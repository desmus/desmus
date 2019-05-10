<?php

namespace App\Repositories;

use App\Models\MessageCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MessageCreateRepository
 * @package App\Repositories
 * @version May 28, 2018, 5:22 pm UTC
 *
 * @method MessageCreate findWithoutFail($id, $columns = ['*'])
 * @method MessageCreate find($id, $columns = ['*'])
 * @method MessageCreate first($columns = ['*'])
*/
class MessageCreateRepository extends BaseRepository
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
        return MessageCreate::class;
    }
}
