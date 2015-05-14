<?php
class Tarea extends Eloquent {
	protected $fillable = ['folio','asunto','areaSolicitante', 'oficio_referencia','fecha_recepcion', 
						   'fecha_respuesta', 'area_generadora', 'nombre_titular', 'ubicacion_topografica', 
						   'estatus','user_id', 'admin_id'];
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