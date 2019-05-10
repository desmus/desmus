<?php

namespace App\Repositories;

use App\Models\ContactAddressView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactAddressViewRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:48 pm UTC
 *
 * @method ContactAddressView findWithoutFail($id, $columns = ['*'])
 * @method ContactAddressView find($id, $columns = ['*'])
 * @method ContactAddressView first($columns = ['*'])
*/
class ContactAddressViewRepository extends BaseRepository
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
        return ContactAddressView::class;
    }
}
