<?php

namespace App\Repositories;

use App\Models\ContactEmailCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactEmailCreateRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:21 pm UTC
 *
 * @method ContactEmailCreate findWithoutFail($id, $columns = ['*'])
 * @method ContactEmailCreate find($id, $columns = ['*'])
 * @method ContactEmailCreate first($columns = ['*'])
*/
class ContactEmailCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_email_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactEmailCreate::class;
    }
}
