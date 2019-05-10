<?php

namespace App\Repositories;

use App\Models\ContactTelephone;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactTelephoneRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:20 pm UTC
 *
 * @method ContactTelephone findWithoutFail($id, $columns = ['*'])
 * @method ContactTelephone find($id, $columns = ['*'])
 * @method ContactTelephone first($columns = ['*'])
*/
class ContactTelephoneRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'telephone',
        'type',
        'contact_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactTelephone::class;
    }
}
