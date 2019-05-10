<?php

namespace App\Repositories;

use App\Models\ContactWebCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactWebCreateRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:22 pm UTC
 *
 * @method ContactWebCreate findWithoutFail($id, $columns = ['*'])
 * @method ContactWebCreate find($id, $columns = ['*'])
 * @method ContactWebCreate first($columns = ['*'])
*/
class ContactWebCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'contact_web_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactWebCreate::class;
    }
}
