<?php

namespace App\Repositories;

use App\Models\ContactTelephoneView;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactTelephoneViewRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:20 pm UTC
 *
 * @method ContactTelephoneView findWithoutFail($id, $columns = ['*'])
 * @method ContactTelephoneView find($id, $columns = ['*'])
 * @method ContactTelephoneView first($columns = ['*'])
*/
class ContactTelephoneViewRepository extends BaseRepository
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
        return ContactTelephoneView::class;
    }
}
