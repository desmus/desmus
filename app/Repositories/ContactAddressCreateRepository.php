<?php

namespace App\Repositories;

use App\Models\ContactAddressCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactAddressCreateRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:48 pm UTC
 *
 * @method ContactAddressCreate findWithoutFail($id, $columns = ['*'])
 * @method ContactAddressCreate find($id, $columns = ['*'])
 * @method ContactAddressCreate first($columns = ['*'])
*/
class ContactAddressCreateRepository extends BaseRepository
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
        return ContactAddressCreate::class;
    }
}
