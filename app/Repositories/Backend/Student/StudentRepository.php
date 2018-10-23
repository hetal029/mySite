<?php

namespace App\Repositories\Backend\Student;

use DB;
use Carbon\Carbon;
use App\Models\Student\Student;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentRepository.
 */
class StudentRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Student::class;

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
                config('module.students.table').'.id',
                config('module.students.table').'.created_at',
                config('module.students.table').'.updated_at',
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
        $student = self::MODEL;
        $student = new $student();
        if ($student->save($input)) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.students.create_error'));
    }

    /**
     * For updating the respective Model in storage
     *
     * @param Student $student
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(Student $student, array $input)
    {
    	if ($student->update($input))
            return true;

        throw new GeneralException(trans('exceptions.backend.students.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param Student $student
     * @throws GeneralException
     * @return bool
     */
    public function delete(Student $student)
    {
        if ($student->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.students.delete_error'));
    }
}
