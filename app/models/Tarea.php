<?php
class Tarea extends Eloquent {

	protected $fillable = ['folio','asunto','areaSolicitante','fechaRespuesta','user_id'];
	public $timestamps = false;

  public function user()
  {
    return $this->belongsTo('User');
  }
  
}