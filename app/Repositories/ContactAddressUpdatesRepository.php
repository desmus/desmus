<?php

namespace App\Repositories;

use App\Models\ContactAddressUpdates;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactAddressUpdatesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:48 pm UTC
 *
 * @method ContactAddressUpdates findWithoutFail($id, $columns = ['*'])
 * @method ContactAddressUpdates find($id, $columns = ['*'])
 * @method ContactAddressUpdates first($columns = ['*'])
*/
class ContactAddressUpdatesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_address_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactAddressUpdates::class;
    }
}
