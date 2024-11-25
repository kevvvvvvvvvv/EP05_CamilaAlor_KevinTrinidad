<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\DbDumper\Databases\MySql;


class DataBaseController extends Controller
{


    /*
        Vista principal para el respaldo y restauración de la base de datos
        Recibe:nada
        Retorna: vista del dashboard para el respaldo y restauración de la base de datos
    
    */
    public function show(){
        return view('db.dashboard');
    }

    /*
        Respaldo de la base de datos
        Recibe: nada
        Retorna: archivo .zip con la información de la base de datos
    */
    public function exportarDatabase()
    {
        Artisan::call('backup:run');
        $backupPath = storage_path('app/Laravel');
        $backupFiles = File::files($backupPath);
    
        if (empty($backupFiles)) {
            return response()->json(['error' => 'No se encontró ningún archivo de respaldo.'], 404);
        }
    
        $latestBackup = end($backupFiles);
    
        return response()->download($latestBackup->getPathname());
    }
    
    /*
        Restauración de la base de datos 
        Recibe: archivo
        Retorna: mensaje de éxito o error a la vista a la que se hizo la 
                 solicitud
    */

    public function restaurarDatabase(Request $request)
    {
        try {
            // Verificar si el archivo se subió correctamente
            $file = $request->file('backup_file');
            if (!$file || !$file->isValid()) {
                return back()->with('error', 'Archivo no válido o no se cargó correctamente.');
            }
    
            // Leer el archivo SQL y ejecutarlo
            $sql = file_get_contents($file->getRealPath());
            DB::unprepared($sql);
            return back()->with('success', 'Se ha restaurado la base de datos de manera correcta');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al restaurar la base de datos.');
        }
        
    }
}
