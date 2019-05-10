<?php

namespace App\Repositories;

use App\Models\UserCalendarEventCreate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCalendarEventCreateRepository
 * @package App\Repositories
 * @version January 23, 2019, 7:31 pm UTC
 *
 * @method UserCalendarEventCreate findWithoutFail($id, $columns = ['*'])
 * @method UserCalendarEventCreate find($id, $columns = ['*'])
 * @method UserCalendarEventCreate first($columns = ['*'])
*/
class UserCalendarEventCreateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datetime',
        'user_id',
        'user_c_e_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserCalendarEventCreate::class;
    }
}
