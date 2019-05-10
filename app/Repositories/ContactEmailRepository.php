<?php

namespace App\Repositories;

use App\Models\ContactEmail;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactEmailRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:20 pm UTC
 *
 * @method ContactEmail findWithoutFail($id, $columns = ['*'])
 * @method ContactEmail find($id, $columns = ['*'])
 * @method ContactEmail first($columns = ['*'])
*/
class ContactEmailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'type',
        'contact_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactEmail::class;
    }
}
