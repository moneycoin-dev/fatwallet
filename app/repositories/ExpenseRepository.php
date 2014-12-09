<?php

use \ValidationException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExpenseRepository implements ExpenseRepositoryInterface {

    /**
	 * Retrive a list of expenses.
	 *
	 * @param  array  $param
	 * @return array
	 */
    public function all($param = array())
    {
        $perPage = isset($param['perPage']) ? $param['perPage'] : 15;
        $orderBy = isset($param['orderBy']) ? strtolower($param['orderBy']) : 'created_at';
        $sort = isset($param['sort']) ? strtoupper($param['sort']) : 'DESC';

        if ( ! is_numeric($perPage)) {
            throw new InvalidArgumentException;
        }

        if ( ! in_array($orderBy, Expense::$sortable)) {
            throw new InvalidArgumentException;
        }

        $valid_sort = array('ASC', 'DESC');
        if ( ! in_array($sort, $valid_sort)) {
            throw new InvalidArgumentException;
        }

        $expenses = Expense::orderBy($orderBy, $sort)->paginate($perPage)->toArray();

        return array(
            'error' => false,
            'expenses' => $expenses
        );
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function find($id)
    {
        if ( ! is_numeric($id)) {
            throw new InvalidArgumentException;
        }

        $expense = Expense::with('category', 'merchant')->where('id', '=', $id)->first();

        if ( ! ($expense instanceof Expense)) {
            return array(
                'error' => false,
                'message' => 'Expense does not exist.'
            );
        }

        return array(
            'error' => false,
            'expense' => $expense->toArray()
        );
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function create($data)
    {

    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($id, $data)
    {

    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function delete($id)
    {

    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function validate($data, $id = null)
    {

    }

    /**
	 * Create an instance.
	 *
	 * @param array $data
	 * @return Model
	 */
    public function instance($data = array())
    {

    }

    /**
     * Return an error message.
     *
     * @return string
     */
    public function error()
    {

    }

}