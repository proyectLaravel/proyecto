<?php

class TaskController extends BaseController {

  public function asignTask(){

  	//$data = Input::only(['folio','oficioReferncia','descripcion']);
  	$data =Input::all();

  	$rules = array(
        'folio'             => 'numeric|required|unique:tasks',
        'oficioReferencia'  => 'required',
        'descripcion'       => 'string|required',
    );
  
    $messages = array(
      'folio.unique'                => 'Folio duplicado.',
      'folio.required'              => 'El folio es obligatorio.',
      'oficioReferencia.required'   => 'El Oficio Referencia es obligatorio.',
      'descripcion.required'        => 'La descripcion es obligatoria.',
    );
   
    $validation = Validator::make($data, $rules, $messages);
   
    if ($validation->fails())
    {
      
        return Redirect::to('dash')->withErrors($validation);

    }else{
	   $task = Task::create($data);

       return View::make('auth/dash');
    }

 }
}
