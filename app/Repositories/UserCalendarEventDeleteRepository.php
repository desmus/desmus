<?php

namespace App\Repositories;

use App\Models\UserCalendarEventDelete;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCalendarEventDeleteRepository
 * @package App\Repositories
 * @version January 23, 2019, 7:32 pm UTC
 *
 * @method UserCalendarEventDelete findWithoutFail($id, $columns = ['*'])
 * @method UserCalendarEventDelete find($id, $columns = ['*'])
 * @method UserCalendarEventDelete first($columns = ['*'])
*/
class UserCalendarEventDeleteRepository extends BaseRepository
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
        return UserCalendarEventDelete::class;
    }
}
