<?php

class TareasController extends BaseController {

  public function saveTarea()
  {
    $path = public_path(). '/files/' . '/' . date("Y")  . '/' . date("m") . '/' . date("d") . '/';
    if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
    }
    if (Input::hasFile('filePdf'))
    {
        $file = Input::file('filePdf')->move($path, time() . '-' . Input::file('filePdf')->getClientOriginalName() ); 
    }
    //$todos = Input::all();
    $user_id         = Input::get('user_id');
    $folio           = Input::get('folio');
    $fechaRespuesta  = Input::get('fecha_respuesta');
    $asunto          = Input::get('asunto');
    $areaSolicitante = Input::get('areaSolicitante');
      
    $rules = array(
          'user_id' => 'numeric',
          'folio' => 'numeric|required',
          'fecha_respuesta' => 'date',
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
        //Input::file('filePdf')->move(public_path(),'NuevoNombre');
        $id = Input::get('user_id');
        $user = User::find($id);
        //var_dump($user->email);
        Mail::send('emails.newTarea', array('first_name'=>$user->first_name), function($message) use ($user){
          $message->to($user->email, $user->first_name.' '.$user->last_name)->subject('Nueva tarea Asignada');
          $message->attach( public_path(). '/files/' . '/' . date("Y")  . '/' . date("m") . '/' . date("d") . '/'.time() . '-' . Input::file('filePdf')->getClientOriginalName());
        });
        return Redirect::back();
    }
  }

  public function getTasksSuperAdmin()
  {
    $tasks = DB::table('tareas')->get(['Folio','areaSolicitante', 'asunto', 'fecha_respuesta', 'user_id']);
    return Response::json(array(
      'tasks' =>  $tasks
    ));
  }

  public function getTasks()
  {
    $tasks = DB::table('tareas')->where('user_id', Auth::user()->id)->get(['Folio','areaSolicitante', 'asunto', 'fecha_respuesta', 'user_id']);
    return Response::json(array(
      'tasks' =>  $tasks
    ));
  }

  public function uploadpdf()
  {
    $path = public_path(). '/files/' . '/' . date("Y")  . '/' . date("m") . '/' . date("d") . '/';
    if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
    }
    if (Input::hasFile('filePdf'))
    {
        $file = Input::file('filePdf')->move($path, time() . '-' . Input::file('filePdf')->getClientOriginalName() ); 
    }
    return Redirect::back();
  }

  public function cleanDD()
  {
    $path = public_path(). '/files/';
    File::deleteDirectory($path,false);
   
    return Redirect::back();
  }


}