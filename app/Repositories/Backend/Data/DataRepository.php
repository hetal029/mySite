<?php

namespace App\Repositories\Backend\Data;

use DB;
use Carbon\Carbon;
use App\Models\Data\Data;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DataRepository.
 */
class DataRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Data::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.data.table').'.id',
                config('module.data.table').'.created_at',
                config('module.data.table').'.updated_at',
            ]);
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @throws GeneralException
     * @return bool
     */
    public function create(array $input)
    {
        $data = self::MODEL;
        $data = new $data();
        if ($data->save($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.data.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Data $data
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Data $data, array $input)
    {
    	if ($data->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.data.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Data $data
     * @throws GeneralException
     * @return bool
     */
    public function delete(Data $data)
    {
        if ($data->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.data.delete_error'));
    }
}
