<?php

namespace App\Repositories;

use App\Models\ContactAdressUpdates;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactAdressUpdatesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:20 pm UTC
 *
 * @method ContactAdressUpdates findWithoutFail($id, $columns = ['*'])
 * @method ContactAdressUpdates find($id, $columns = ['*'])
 * @method ContactAdressUpdates first($columns = ['*'])
*/
class ContactAdressUpdatesRepository extends BaseRepository
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
        return ContactAdressUpdates::class;
    }
}
