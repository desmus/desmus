<?php

namespace App\Repositories;

use App\Models\ContactAddressDeletes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactAddressDeletesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:48 pm UTC
 *
 * @method ContactAddressDeletes findWithoutFail($id, $columns = ['*'])
 * @method ContactAddressDeletes find($id, $columns = ['*'])
 * @method ContactAddressDeletes first($columns = ['*'])
*/
class ContactAddressDeletesRepository extends BaseRepository
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
        return ContactAddressDeletes::class;
    }
}
