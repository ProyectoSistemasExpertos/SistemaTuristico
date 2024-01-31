<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerRoles extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $rol = Rol::all();
            return response()->json($rol);
        } else {
            $rol = Rol::findorfail($id);
            return response()->json($rol);
        }
    } //End of index

    public function store(Request $request)
    {
        try {
            $request->validate([
                'typeRol' => 'required'
            ]);

            $input = $request->all();
            $rol = new Rol();
            $rol->typeRol = $input['typeRol'];
            $rol->save();

            return response()->json($rol);
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } //End try-catch
    } //End of store


    //está teniendo problemas!
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'typeRol' => 'required'
            ]);

            $rol = Rol::find($id);

            if (!$rol) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
            } else {
                $rol->typeRol = $request->typeRol;
                $rol->save();
                return response()->json($rol);
            }//end if exists
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: La categoría o estado especificada no existe.'], 400);
            }
        } //End try-catch
    } //End of update

    public function destroy($id){
        $rol = Rol::where('idrol', $id)->first();
        if (!$rol) {
            return response()->json(['error' => 'La categoría no existe'], 404);
        }
        try {
            $rol->delete();
            return response()->json(['message' => 'Se ha eliminado correctamente!'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'No se pudo eliminar el rol', 'exception' => $e->getMessage()], 500);
        }//end catch
    }//end destroy
}//End controllerRoles
