<?php

namespace App\Repositories;

use App\Models\ContactWeb;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactWebRepository
 * @package App\Repositories
 * @version July 9, 2018, 9:22 pm UTC
 *
 * @method ContactWeb findWithoutFail($id, $columns = ['*'])
 * @method ContactWeb find($id, $columns = ['*'])
 * @method ContactWeb first($columns = ['*'])
*/
class ContactWebRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'link',
        'contact_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactWeb::class;
    }
}
