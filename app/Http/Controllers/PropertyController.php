<?php

namespace App\Http\Controllers;

use App\Interfaces\PropertyRepositoryInterface;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    private PropertyRepositoryInterface $propertyRepository;

    public function __construct(PropertyRepositoryInterface $propertyRepository) 
    {
        $this->propertyRepository = $propertyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->propertyRepository->getAllProperties());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function propertiesType()
    {
        return response()->json($this->propertyRepository->getAllTypes());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Http\Requests\StorePropertyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyRequest $request)
    {
        $validated = $request->validated();
        return response()->json($this->propertyRepository->createProperty($validated));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        return response()->json($this->propertyRepository->getPropertyById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Http\Requests\UpdatePropertyRequest  $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertyRequest $request, string $id)
    {
        $validated = $request->validated();
        return response()->json($this->propertyRepository->updateProperty($id, $validated));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $this->propertyRepository->deleteProperty($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
