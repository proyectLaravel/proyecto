<?php
class Tarea extends Eloquent {

	protected $fillable = ['folio','asunto','areaSolicitante','fecha_respuesta','user_id'];
	public $timestamps = false;

	public function setFechaRespuesta($value)
	{
	    $this->attributes['fecha_respuesta'] = date("yy-mm-dd", strtotime($value) );
	}
  
    public function user()
    {
    	return $this->belongsTo('User');
    }
  
}