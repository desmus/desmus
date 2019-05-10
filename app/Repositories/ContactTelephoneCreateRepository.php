<?php

namespace App\Repositories;

use App\Models\ContactTelephoneCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactTelephoneCreateRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:20 pm UTC
 *
 * @method ContactTelephoneCreate findWithoutFail($id, $columns = ['*'])
 * @method ContactTelephoneCreate find($id, $columns = ['*'])
 * @method ContactTelephoneCreate first($columns = ['*'])
*/
class ContactTelephoneCreateRepository extends BaseRepository
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
        return ContactTelephoneCreate::class;
    }
}
