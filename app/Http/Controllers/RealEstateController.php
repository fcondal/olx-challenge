<?php

namespace App\Http\Controllers;

use App\Http\Resources\RealEstateTransformer;
use App\RealEstate;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\RealEstateCollection;
use App\Http\Resources\MessageTransformer;

class RealEstateController extends BaseController
{
    /**
     * Return a list of real estate
     *
     * @param Request $request
     * @return RealEstateCollection
     */
    public function index(Request $request)
    {
        $realEstate = RealEstate::search($request->all())->paginate(50);

        return new RealEstateCollection($realEstate);
    }

    /**
     * Return a real estate
     *
     * @param $id
     * @return RealEstateTransformer
     */
    public function show($id)
    {
        $realEstate = RealEstate::findOrFail($id);

        return new RealEstateTransformer($realEstate);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tipo_operacion'     => 'required|integer|exists:operation_types,id',
        ]);

        $realEstate = RealEstate::findOrFail($id);
        $realEstate->update([
            'operation_type_id' => $request->tipo_operacion
        ]);
        $data = ['message' => 'La propiedad se ha modificado correctamente'];

        return new MessageTransformer($data);
    }

    /**
     * Delete a real estate
     *
     * @param $id
     * @return MessageTransformer
     */
    public function destroy($id)
    {
        $realEstate = RealEstate::findOrFail($id);
        $realEstate->delete();
        $data = ['message' => 'La propiedad se ha eliminado correctamente'];

        return new MessageTransformer($data);
    }

}