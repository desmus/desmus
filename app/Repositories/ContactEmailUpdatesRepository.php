<?php

namespace App\Repositories;

use App\Models\ContactEmailUpdates;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactEmailUpdatesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:21 pm UTC
 *
 * @method ContactEmailUpdates findWithoutFail($id, $columns = ['*'])
 * @method ContactEmailUpdates find($id, $columns = ['*'])
 * @method ContactEmailUpdates first($columns = ['*'])
*/
class ContactEmailUpdatesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_email_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactEmailUpdates::class;
    }
}
