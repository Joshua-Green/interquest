<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTerritoryAPIRequest;
use App\Http\Requests\API\UpdateTerritoryAPIRequest;
use App\Models\Territory;
use App\Repositories\TerritoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TerritoryController
 * @package App\Http\Controllers\API
 */

class TerritoryAPIController extends AppBaseController
{
	/** @var  TerritoryRepository */
	private $territoryRepository;

	public function __construct(TerritoryRepository $territoryRepo)
	{
		$this->territoryRepository = $territoryRepo;
	}

	/**
	 * Display a listing of the Territory.
	 * GET|HEAD /territories
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
		$this->territoryRepository->pushCriteria(new RequestCriteria($request));
		$this->territoryRepository->pushCriteria(new LimitOffsetCriteria($request));
		$territories = $this->territoryRepository->all();

		return $this->sendResponse($territories->toArray(), 'Territories retrieved successfully');
	}

	/**
	 * Store a newly created Territory in storage.
	 * POST /territories
	 *
	 * @param CreateTerritoryAPIRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateTerritoryAPIRequest $request)
	{
		$input = $request->all();

		$territories = $this->territoryRepository->create($input);

		return $this->sendResponse($territories->toArray(), 'Territory saved successfully');
	}

	/**
	 * Display the specified Territory.
	 * GET|HEAD /territories/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		/** @var Territory $territory */
		$territory = $this->territoryRepository->findWithoutFail($id);

		if (empty($territory)) {
			return $this->sendError('Territory not found');
		}

		return $this->sendResponse($territory->toArray(), 'Territory retrieved successfully');
	}

	/**
	 * Update the specified Territory in storage.
	 * PUT/PATCH /territories/{id}
	 *
	 * @param  int $id
	 * @param UpdateTerritoryAPIRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateTerritoryAPIRequest $request)
	{
		$input = $request->all();

		/** @var Territory $territory */
		$territory = $this->territoryRepository->findWithoutFail($id);

		if (empty($territory)) {
			return $this->sendError('Territory not found');
		}

		$territory = $this->territoryRepository->update($input, $id);

		return $this->sendResponse($territory->toArray(), 'Territory updated successfully');
	}

	/**
	 * Remove the specified Territory from storage.
	 * DELETE /territories/{id}
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var Territory $territory */
		$territory = $this->territoryRepository->findWithoutFail($id);

		if (empty($territory)) {
			return $this->sendError('Territory not found');
		}

		$territory->delete();

		return $this->sendResponse($id, 'Territory deleted successfully');
	}
	
	/**
	 * Get the territories around this one, in this one's sector
	 *
	 * @return Response
	 */
	public function map($id)
	{
		
		//get the territory
		$territory = $this->territoryRepository->findWithoutFail($id);
		
		//check
		if(empty($territory)){
			return $this->sendError('Territory not found');
		}else{
			
			//define borders
			$colMod = $territory->column - 4;
			$rowMod = $territory->row - 4;
			
			//build array
			$responseData = [
				'colMod'		=> $colMod,
				'rowMod'		=> $rowMod,
				'territories'	=> []
			];
			for($row = 0; $row < 10; $row++){
				for($column = 0; $column < 10; $column++){
					$tt = \App\Models\Territory::where('column', $colMod + $column)->where('row', $rowMod + $row)->first();
					if($tt){
						$responseData['territories'] = [
							$tt->column . '-' . $tt->row => [
								'id'		=> $tt->id,
								'name'		=> $tt->name,
								'terrain'	=> $tt->terrain->name,
								'cs'		=> $tt->castle_strength,
								'fiefdom'	=> $tt->fief ? $tt->fief->fiefdom : null
							]
						] + $responseData['territories'];
					}else{
						$responseData['territories'] = [
							($colMod + $column) . '-' . ($rowMod + $row) => [
								'id'		=> '',
								'name'		=> 'Undiscovered',
								'terrain'	=> 'Undiscovered',
								'cs'		=> 0,
								'fiefdom_id'=> null
							]
						] + $responseData['territories'];
					}
				}
			}
			return $this->sendResponse($responseData, 'Territory Sector retrieved successfully');
		}
	}
}
