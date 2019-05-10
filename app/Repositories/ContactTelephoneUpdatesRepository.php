<?php

namespace App\Repositories;

use App\Models\ContactTelephoneUpdates;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactTelephoneUpdatesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:20 pm UTC
 *
 * @method ContactTelephoneUpdates findWithoutFail($id, $columns = ['*'])
 * @method ContactTelephoneUpdates find($id, $columns = ['*'])
 * @method ContactTelephoneUpdates first($columns = ['*'])
*/
class ContactTelephoneUpdatesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_telephone_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactTelephoneUpdates::class;
    }
}
