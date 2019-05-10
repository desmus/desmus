<?php

namespace App\Repositories;

use App\Models\ContactTelephoneDeletes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactTelephoneDeletesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:20 pm UTC
 *
 * @method ContactTelephoneDeletes findWithoutFail($id, $columns = ['*'])
 * @method ContactTelephoneDeletes find($id, $columns = ['*'])
 * @method ContactTelephoneDeletes first($columns = ['*'])
*/
class ContactTelephoneDeletesRepository extends BaseRepository
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
        return ContactTelephoneDeletes::class;
    }
}
