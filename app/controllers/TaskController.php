<?php

class TaskController extends BaseController {

  public function asignTask(){
    $data = Input::only(['folio','oficioReferncia','descripcion']);

    $task = Task::create($data);

    return View::make('auth/dash');

  }

}
