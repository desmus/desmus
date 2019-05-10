<?php

namespace App\Repositories;

use App\Models\ContactAddress;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactAddressRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:48 pm UTC
 *
 * @method ContactAddress findWithoutFail($id, $columns = ['*'])
 * @method ContactAddress find($id, $columns = ['*'])
 * @method ContactAddress first($columns = ['*'])
*/
class ContactAddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'street',
        'num_ext',
        'num_int',
        'state',
        'municipality',
        'postal_code',
        'location',
        'contact_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactAddress::class;
    }
}
