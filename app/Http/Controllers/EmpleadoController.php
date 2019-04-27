<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;

use App\Http\Requests\CreateEmpleadoRequest;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Empleado::where('id', $id)->get();
        $todos = array();
        foreach ($all as $key => $emp) {
            $e = $emp->getAttributes();
            $s = $emp->skills()->get();
            $skills = array();
            foreach ($s as $key => $skill) {
                $skills[] = $skill->getAttributes();
            }
            $e['skills'] = $skills;
            $todos[] = $e;
        }

        return collect($todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmpleadoRequest $request)
    {
        $inputs = $request->all();
        $empleado = Empleado::create(['nombre' => $inputs['nombre']
                                     ,'email' => $inputs['email']
                                     ,'puesto' => $inputs['puesto']
                                     ,'domicilio' => $inputs['domicilio']
                                     ,'fecha_nacimiento' => $inputs['fecha_nacimiento']
        ]);

        foreach ($inputs['skills'] as $key => $skill) {
            $empleado->skill()->create(['nombre' => $skill['nombre']
                                       ,'calificacion' => $skill['calificacion']
            ]);
        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
