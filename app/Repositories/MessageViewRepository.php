<?php

namespace App\Repositories;

use App\Models\MessageView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MessageViewRepository
 * @package App\Repositories
 * @version May 28, 2018, 5:22 pm UTC
 *
 * @method MessageView findWithoutFail($id, $columns = ['*'])
 * @method MessageView find($id, $columns = ['*'])
 * @method MessageView first($columns = ['*'])
*/
class MessageViewRepository extends BaseRepository
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
        return MessageView::class;
    }
}
