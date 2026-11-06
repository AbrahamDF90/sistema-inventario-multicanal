<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController;
use App\Models\Producto; // <-- Asegúrate de que esta línea esté arriba

// ... Tus rutas anteriores (apiResource o las que hayas puesto) ...

// El código nuevo que vas a pegar:
Route::get('/interno/productos/{producto}', function (Request $request, Producto $producto) {
    $clave = (string) env('GRPC_INTERNAL_KEY', '');
    
    abort_if(
        $clave === '' || !hash_equals($clave, (string) $request->header('X-Internal-Key')), 
        403
    );
    
    return response()->json($producto);
});