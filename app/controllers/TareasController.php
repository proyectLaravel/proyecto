<?php

class TareasController extends BaseController {

  public function saveTarea()
  {
    //$todos = Input::all();
    $user_id         = Input::get('user_id');
    $folio           = Input::get('folio');
    $fechaRespuesta  = Input::get('fechaRespuesta');
    $asunto          = Input::get('asunto');
    $areaSolicitante = Input::get('areaSolicitante');
      
    $rules = array(
          'user_id' => 'numeric',
          'folio' => 'numeric|required',
          'fechaRespuesta' => 'date',
          'asunto' => 'string',
          'areaSolicitante' => 'string'
      );
  
    $messages = array(
        'required' => 'El campo es obligatorio.',
        'numeric' => 'El campo debe ser un número.',
        'max' => 'El campo :attribute no puede tener más de :min carácteres.'
    );
   
    $validation = Validator::make(Input::all(), $rules, $messages);
   
    if ($validation->fails())
    {
      
        return Redirect::to('dash')->withErrors($validation)->withInput();
 
    }else{

        $newTarea = Tarea::create(Input::all());
        $id = Input::get('user_id');
        $user = User::find($id);
        var_dump($user->email);
        Mail::send('emails.newTarea', array('first_name'=>$user->first_name), function($message) use ($user){
          $message->to($user->email, $user->first_name.' '.$user->last_name)->subject('Nueva tarea Asignada');
        });
    }
  }

  public function getTasks()
  {
    $tasks = DB::table('tareas')->get(['Folio','areaSolicitante', 'asunto', 'fechaRespuesta', 'user_id']);
    return Response::json(array(
      'tasks' =>  $tasks
    ));
  }

}