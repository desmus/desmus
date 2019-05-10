<?php

namespace App\Repositories;

use App\Models\ContactAdressDeletes;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactAdressDeletesRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:20 pm UTC
 *
 * @method ContactAdressDeletes findWithoutFail($id, $columns = ['*'])
 * @method ContactAdressDeletes find($id, $columns = ['*'])
 * @method ContactAdressDeletes first($columns = ['*'])
*/
class ContactAdressDeletesRepository extends BaseRepository
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
        return ContactAdressDeletes::class;
    }
}
