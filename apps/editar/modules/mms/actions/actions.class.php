<?php
/**
 * MODULO MMS ACTIONS. 
 * Modulo de administracion de los objetos multimedia. Permite administrar
 * los objetos multimedia de una serie. Su formulario de edicion se divide en 
 * cuatro pestanas:
 *   -Metadatos
 *   -Areas de conocimiento
 *   -Personas
 *   -Multimedia 
 *
 * @package    pumukit
 * @subpackage mms
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class mmsActions extends sfActions
{
  /**
   * --  INDEX -- /editar.php/mms/index/serial/:id
   *
   * Accion por defecto del modulo. Layout: layout
   * Parametros por URL: identificador de la serie.
   *
   */
  public function executeIndex()
  {
    $this->serial = SerialPeer::retrieveByPKWithI18n($this->getRequestParameter('serial'), $this->getUser()->getCulture());
    $this->forward404Unless($this->serial);

    sfConfig::set('serial_menu','active');
   
    $this->getUser()->setAttribute('serial', $this->getRequestParameter('serial'));

    //si cambias de serie tienes que cambiar de pagina
    if((!$this->getUser()->hasAttribute('page', 'tv_admin/mm'))||
       (($this->getUser()->getAttribute('serial') != $this->getRequestParameter('serial'))))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/mm');
    if(!$this->getUser()->hasAttribute('id', 'tv_admin/mm'))
      $this->getUser()->setAttribute('id', 0, 'tv_admin/mm');
  }


  /**
   * --  LIST -- /editar.php/mms/list
   *
   * Sin parametros
   *
   */
  public function executeList()
  {
    return $this->renderComponent('mms', 'list');
  }




  /**
   * --  UPDATELISTPUB -- /editar.php/mms/update_list_pub_channel
   *
   * Parametros por URL: identificador del objeto mulimedia 
   *
   */
  public function executeUpdatelistpub()
  {
    $mm_id = $this->getRequestParameter('id', 0);  //OJO SI NO EXISTEN
    $this->mm = MmPeer::retrieveByPk($mm_id); 
    
    return $this->renderPartial('list_pub');
  }


  /**
   * --  EDIT -- /editar.php/mms/edit/id/:id
   *
   * Parametros por URL: Identificador el objeto multimedia
   *
   */
  public function executeEdit()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/mm');
    }
    return $this->renderComponent('mms', 'edit');
  }


  /**
   * --  PREVIEW -- /editar.php/mms/preview/id/:id
   *
   * Parametros por URL: Identificador el objeto multimedia
   *
   */
  public function executePreview()
  {
    //session _request ID o 0 si no hay
    $this->roles = RolePeer::doSelectWithI18n(new Criteria());
    $this->mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    return $this->renderPartial('mms/preview');
  }


  /**
   * --  UPDATE -- /editar.php/mms/update
   *
   * Parametros por POST: Serializacion de formulario
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $mm = new Mm();
    }
    else
    {
      $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($mm);
    }

    
    /* STATUS */
    /*if ($this->getUser()->getAttribute('user_type_id', 1) == 0){
      $mm->setStatusId($this->getRequestParameter('status', 0));
    }*/

    /* DATES */
    if ($this->getRequestParameter('publicdate'))
    {
      $timestamp = sfI18N::getTimestampForCulture($this->getRequestParameter('publicdate'), $this->getUser()->getCulture());      
      $mm->setPublicdate($timestamp);
    }

    if ($this->getRequestParameter('recorddate'))
    {
      $timestamp = sfI18N::getTimestampForCulture($this->getRequestParameter('recorddate'), $this->getUser()->getCulture());      
      $mm->setRecorddate($timestamp);
    }
    
    /* METADATA */
    //$mm->setAnnounce($this->getRequestParameter('announce', 0));
    //$mm->setBroadcastId($this->getRequestParameter('broadcast_id', 0));

    $mm->setSubserial($this->getRequestParameter('subserial', 0));
    $mm->setCopyright($this->getRequestParameter('copyright', 0));
    $mm->setPrecinctId($this->getRequestParameter('precinct_id', 0));
    $mm->setGenreId($this->getRequestParameter('genre_id', 0));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $mm->setCulture($lang);
      $mm->setTitle($this->getRequestParameter('title_' . $lang, 0));
      $mm->setSubtitle($this->getRequestParameter('subtitle_' . $lang, 0));
      $mm->setKeyword($this->getRequestParameter('keyword_' . $lang, ' '));
      $mm->setDescription($this->getRequestParameter('description_' . $lang, ' '));
      $mm->setLine2($this->getRequestParameter('line2_' . $lang, ' '));
      $mm->setSubserialTitle($this->getRequestParameter('subserial_title_' . $lang, ' '));
    }
    
    $mm->save();

    return $this->renderComponent('mms', 'list');
  }



  /**
   * --  UPDATE_PUB -- /editar.php/mms/update_pub
   *
   *
   */
  public function executeUpdate_pub()
  {

    $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($mm);

    $mm->setDescription($this->getRequestParameter('description', 0));

    $mm->setAnnounce($this->getRequestParameter('announce', 0));
    $mm->setEditorial1($this->getRequestParameter('editorial1', 0));
    $mm->setEditorial2($this->getRequestParameter('editorial2', 0));
    $mm->setEditorial3($this->getRequestParameter('editorial3', 0));

    $mm->setBroadcastId($this->getRequestParameter('broadcast_id', 0));
    if(($mm->getStatusId() == 0)&&($this->getRequestParameter('status') == 1)){
      // de normal a bloqueado
      $this->enBloq = true;
    }elseif(($mm->getStatusId() == 1)&&($this->getRequestParameter('status') == 0)){
      // de bloqueado a normal
      $this->desBloq = true;
    }
    if ($this->getUser()->getAttribute('user_type_id', 1) == 0){
      $mm->setStatusId($this->getRequestParameter('status', 0));
    }
    //CAMBIAR CANALES DE PUB Y MIRAR SI SE PUEDE
    //	

    $mm->save();


    /*
      Recorro la lista de todos viendo cuales se acaban de selecionar o de quitar 
      para llamar el su clase a la funcion correspondiente para emprezar el workflow.
     */

    if($mm->updatePubChannels($this->getRequestParameter('pub_channels'))){
      $this->reload_pub_channel = true;
      $this->msg_alert = array('info', "Objeto multimedia actualizado.");
    }else{
      $this->msg_alert = array('error', "Objeto multimedia  \"" . $mm->getTitle() . "\" NO tiene master.");
      $this->reload_pub_channel = true;
    }
    
    
    $this->mm_sel = $mm;
    $this->reload_pub_channel = true;
    
    return $this->renderComponent('mms', 'list');

  }


  /**
   * --  ITUNES_ON -- /editar.php/mms/ituneson
   *
   * Parametros por GET: MM_ID 
   *
   */
  public function executeItuneson()
  {
    $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($mm);

    /* Asegurarme que esta en la serie ok */
    if($mm->getStatusId() != 4){
      return $this->renderText('<span style="font-weight:bolder; color:red">Error</span> El estado del objeto multimedia tiene que incluir ItunesU.');
    }
    
    /* Si estado en mayor que (iTunes) compruebo que esiste podcast_audio** */
    if(($status_id > 3)&&(count($mm->getGrounds(3)) == 0)){
      return $this->renderText('<span style="font-weight:bolder; color:red">Error</span> El Objeto Multimedia no esta catalogado en iTunesU');
    }

    /*Ver si la serie esta publicada */
    $this->itunes = $mm->getSerial()->getSerialItuness(); 
    if(!empty($this->itunes)){
      return $this->renderPartial('mms/itunes_list');
    }

    itunes::AddCourse($mm->getSerialId());

    /*TEST */
    $this->itunes = $mm->getSerial()->getSerialItuness();
    return $this->renderPartial('mms/itunes_list');
    /*FIXME LISTAR ENLACES BIEN*/
    //return $this->renderText("Publicacion correcta");
  }



  /**
   * --  ITUNES_OFF -- /editar.php/mms/itunesoff
   *
   * Parametros por GET: MM_ID 
   *
   */
  public function executeItunesoff()
  {
    $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($mm);

    /* Asegurarme que esta en la serie ok */
    if($mm->getStatusId() != 4){
      return $this->renderText('<span style="font-weight:bolder; color:red">Error</span> El estado del objeto multimedia tiene que incluir ItunesU.');
    }
    
    /*Ver si la serie esta publicada */
    $this->itunes = $mm->getSerial()->getSerialItuness(); 
    if(!empty($this->itunes)){
      foreach($this->itunes as $hi){
	itunes::DeleteCourse($hi->getItunesId());
      }
    }
    

    return $this->renderText("Publicacion correcta");
  }


  /**
   * --  CREATE -- /editar.php/mms/create/serial/:serial
   * Al contrario que en otros modulos, no se muestra el formulario vacio para crear
   * despues el objeto, sino que se crea directametne con los valores por defecto
   *
   * Parametros por URL: Identificador de la serie.
   *
   */
  public function executeCreate()
  {
    MmPeer::createNew($this->getUser()->getAttribute('serial'));

    return $this->renderComponent('mms', 'list');
  }


  /**
   * --  DELETE -- /editar.php/mms/delete
   * OJO: Borra en cascada.
   *
   * Parametros por URL: identificador del obj. multimedia. o por POST: array en JSON de identificadores
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $mms = array_reverse(MmPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids'))));
      
      foreach($mms as $mm){
	$mm->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
      $mm->delete();
    }

    $text = '<script type="text/javascript"> click_fila_edit("mm", null, -1)</script>';
    $this->getResponse()->setContent($this->getResponse()->getContent().$text);
    return $this->renderComponent('mms', 'list');
  }


  /**
   * --  COPY -- /editar.php/mms/copy
   *
   * Parametros por URL: identificador del objeto multimedia
   *
   */
  public function executeCopy()
  {
    $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($mm);

    $mm2 = $mm->copy();
    $this->getUser()->setAttribute('mm', $mm2->getId() ); //selecione el nuevo                                                                                                
    return $this->renderComponent('mms', 'list');
  }


  /**
   * --  ANNOUNCE -- /editar.php/mms/announce
   *
   * Parametros por POST: array en JOSN de identificadores de objeto multimedia  
   *
   */
  public function executeAnnounce()
  {
    if($this->hasRequestParameter('ids')){
      $mms = MmPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($mms as $mm){
	$mm->setAnnounce(!$mm->getAnnounce());
	$mm->save();
      }

    }elseif($this->hasRequestParameter('id')){
      $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
      $mm->setAnnounce(!$mm->getAnnounce());
      $mm->save();
    }

    return $this->renderComponent('mms', 'list');
  }




  /**
   * --  CHANGE PUB -- /editar.php/serials/changePub
   *
   * Parametros por URL: identificador de la serie. Layout: none
   *
   */
  public function executeAnnouncech()
  {
    $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($mm);
    
    if($this->getRequestParameter('type') == "all"){

      $achs = AnnounceChannelPeer::doSelect(new Criteria());
      foreach($achs as $ach){
	$ach->announceMm($mm);
      }
      
    }else{
      $ach = AnnounceChannelPeer::retrieveByPk($this->getRequestParameter('type'));
      $this->forward404Unless($ach);
      $ach->announceMm($mm);
    }

    $this->msg_alert = array('info', "Serie \"" . $mm->getTitle() . "\" anunciada OK.");
    return $this->renderComponent('mms', 'list');    
  }




  /**
   * --  ORDERBY -- /editar.php/serials/orderby
   *
   * Parametros por URL: identificador de la serie y tipo de ordenacion (rec_asc, rec_des, pub_asc, pub_des).
   *
   */
  public function executeOrderby()
  {
    $serial = SerialPeer::retrieveByPKWithI18n($this->getRequestParameter('serial'), $this->getUser()->getCulture());
    $this->forward404Unless($serial);
    
    $c = new Criteria();
    $c->add(MmPeer::SERIAL_ID, $serial->getId());

    if('rec_asc' == $this->getRequestParameter('type')){
      $c->addAscendingOrderByColumn(MmPeer::RECORDDATE);
      $this->msg_alert = array('info', "Serie \"" . $serial->getTitle() . "\" reordenada por fecha de grabacion de modo ascendiente.");
    }elseif('rec_des' == $this->getRequestParameter('type')){
      $c->addDescendingOrderByColumn(MmPeer::RECORDDATE);
      $this->msg_alert = array('info', "Serie \"" . $serial->getTitle() . "\" reordenada por fecha de grabacion de modo descendiente.");
    }elseif('pub_asc' == $this->getRequestParameter('type')){
      $c->addAscendingOrderByColumn(MmPeer::PUBLICDATE);
      $this->msg_alert = array('info', "Serie \"" . $serial->getTitle() . "\" reordenada por fecha de publicacion de modo ascendiente.");
    }elseif('pub_des' == $this->getRequestParameter('type')){
      $c->addDescendingOrderByColumn(MmPeer::PUBLICDATE);
      $this->msg_alert = array('info', "Serie \"" . $serial->getTitle() . "\" reordenada por fecha de publicacion de modo ascendiente.");
    }

    $mms = MmPeer::doSelect($c);
    $rank = 1;
    foreach($mms as $mm){
      $mm->setRank($rank++);
      $mm->save();
    }

    return $this->renderComponent('mms', 'list');
  }


  /**
   * --  CHANGE -- /editar.php/mms/change
   *
   * Parametros por POST: array en JOSN de ids y nuevo estado
   *
   */
  public function executeChange()
  {
    $status = intval($this->getRequestParameter('status'));
    if(($status < -1)||($status > 3)) return $this->renderComponent('mms', 'list');
    if ($this->getUser()->getAttribute('user_type_id', 1) != 0) return $this->renderComponent('mms', 'list');


    if($this->hasRequestParameter('ids')){
      $mms = MmPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));


      foreach($mms as $mm){
	$mm->setStatusId($status);
	$mm->save();
      }
      

    }elseif($this->hasRequestParameter('id')){
      $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
      $mm->setStatusId($status);
      $mm->save();

    }elseif($this->getRequestParameter('all')){
      $mms = MmPeer::doSelect(new Criteria());
	    
      foreach($mms as $mm){
	$mm->setStatusId($status);
	$mm->save();
      }
    }

    return $this->renderComponent('mms', 'list');
  }

  /**
   * --  UP -- /editar.php/mms/up
   *
   * Parametros por URL: identificador del objeto mulimedia
   *
   */
  public function executeUp()
  {
    $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($mm);

    $mm->moveUp();
    $mm->save();

    //return $this->redirect('mms/list');
    return $this->renderComponent('mms', 'list');
  }


  /**
   * --  DOWN -- /editar.php/mms/down
   *
   * Parametros por URL: identificador del objeto mulimedia
   *
   */
  public function executeDown()
  {
    $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($mm);

    $mm->moveDown();
    $mm->save();

    //return $this->redirect('mms/list');
    return $this->renderComponent('mms', 'list');
  }


  /**
   * --  TOP -- /editar.php/mms/top
   *
   * Parametros por URL: identificador del objeto mulimedia
   *
   */
  public function executeTop()
  {
    $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($mm);

    $mm->moveToTop();
    $mm->save();

    return $this->renderComponent('mms', 'list');
  }


  /**
   * --  BUTTOM -- /editar.php/mms/buttom
   *
   * Parametros por URL: identificador del objeto mulimedia
   *
   */
  public function executeBottom()
  {
    $mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($mm);

    $mm->moveToBottom();
    $mm->save();

    //return $this->redirect('mms/list');
    return $this->renderComponent('mms', 'list');
  }

  /**
   * --  ADDGROUND -- /editar.php/mms/addground
   *
   * Parametros por URL: identificador del objeto mulimedia e identificador del area de con.
   *
   */
  public function executeAddGround()
  {
    $mm_id = $this->getRequestParameter('id', 0);  //OJO SI NO EXISTEN
    $ground_id = $this->getRequestParameter('ground', 0);  //OJO SI NO EXISTEN
    $this->mm = MmPeer::retrieveByPk($mm_id); 
    
    $this->mm->setGroundId($ground_id);

    $c = new Criteria();
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(GroundTypePeer::RANK);
    $this->groundtypes = GroundTypePeer::doSelectWithI18n($c, 'es'); 


    $cg = new Criteria();
    $cg->addAscendingOrderByColumn(GroundI18nPeer::NAME);
    $this->grounds = GroundPeer::doSelectWithI18n($cg, $this->getUser()->getCulture());

    $this->grounds_sel = $this->mm->getGrounds();

    return $this->renderPartial('edit_ground');
  }


  /**
   * --  DELETEGROUND -- /editar.php/mms/deleteground
   *
   * Parametros por URL: identificador del objeto mulimedia e identificador del area de con.
   *
   */
  public function executeDeleteGround()
  {
    $mm_id = $this->getRequestParameter('id', 0);  //OJO SI NO EXISTEN
    $ground_id = $this->getRequestParameter('ground', 0);  //OJO SI NO EXISTEN

    $gv = GroundMmPeer::retrieveByPK($ground_id, $mm_id);
    if (isset($gv)) $gv->delete();

    
    $c = new Criteria();
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(GroundTypePeer::RANK);
    $this->groundtypes = GroundTypePeer::doSelectWithI18n($c, 'es'); 

    $this->mm = MmPeer::retrieveByPk($mm_id); 
    $this->grounds_sel = $this->mm->getGrounds();
    $this->grounds = GroundPeer::doSelectWithI18n(new Criteria(), 'es');

    return $this->renderPartial('edit_ground');
  }


  /**
   * --  RELAIONGROUND -- /editar.php/mms/relaionground
   *
   * Parametros por URL: 
   *          -identificador del objeto mulimedia 
   *          -identificadores de las areas de conociemiento
   *          -verbo que indoca la accion (incluir o eliminar)
   *
   */
  public function executeRelationgrounds()
  {
    $mm_id = $this->getRequestParameter('id', 0);  //OJO SI NO EXISTEN
    $ground_ids = $this->getRequestParameter('ground_ids');

    if('incluir' == $this->getRequestParameter('function', 0)){
      foreach($ground_ids as $ground_id){
	$gv =  GroundMmPeer::retrieveByPK($ground_id, $mm_id);
	if (!$gv){
	  $gv = new GroundMm();
	  $gv->setMmId($mm_id);
	  $gv->setGroundId($ground_id);
	  $gv->save();
	}
      } 
    }elseif('eliminar' == $this->getRequestParameter('function', 0)){
      foreach($ground_ids as $ground_id){
	$gv = GroundMmPeer::retrieveByPK($ground_id, $mm_id);
	if (isset($gv)) $gv->delete();
      }
    }

    $c = new Criteria();
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(GroundTypePeer::RANK);
    $this->groundtypes = GroundTypePeer::doSelectWithI18n($c, 'es'); 

    $this->mm = MmPeer::retrieveByPk($mm_id); 
    $this->grounds = GroundPeer::doSelectWithI18n(new Criteria(), 'es');
    $this->grounds_sel = $this->mm->getGrounds();

    return $this->renderPartial('edit_ground');    
  }

  /**
   * Deprecated
   * --  ADDGROUNDS -- /editar.php/mms/addgrounds
   *
   * Parametros por URL: identificador del objeto mulimedia e identificador del area de con.
   *
   */
  public function executeAddGrounds()
  {
    $mm_id = $this->getRequestParameter('id', 0);  //OJO SI NO EXISTEN
    $ground_ids = explode('_', $this->getRequestParameter('grounds'));  //OJO SI NO EXISTEN

    foreach($ground_ids as $ground_id){
      $gv =  GroundMmPeer::retrieveByPK($ground_id, $mm_id);
      if (!$gv){
	$gv = new GroundMm();
	$gv->setMmId($mm_id);
	$gv->setGroundId($ground_id);
	$gv->save();
      }
    }

    $c = new Criteria();
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(GroundTypePeer::RANK);
    $this->groundtypes = GroundTypePeer::doSelectWithI18n($c, 'es'); 

    $this->mm = MmPeer::retrieveByPk($mm_id); 
    $this->grounds = GroundPeer::doSelectWithI18n(new Criteria(), 'es');
    $this->grounds_sel = $this->mm->getGrounds();

    return $this->renderPartial('edit_ground');
  }


  /**
   * Deprecated
   * --  DELETEGROUNDS -- /editar.php/mms/deletegrounds
   *
   * Parametros por URL: identificador del objeto mulimedia e identificador del area de con.
   *
   */
  public function executeDeleteGrounds()
  {
    $mm_id = $this->getRequestParameter('id', 0);  //OJO SI NO EXISTEN
    $ground_ids = explode('_', $this->getRequestParameter('grounds'));  //OJO SI NO EXISTEN

    foreach($ground_ids as $ground_id){
      $gv = GroundMmPeer::retrieveByPK($ground_id, $mm_id);
      if (isset($gv)) $gv->delete();
    }
    
    $c = new Criteria();
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(GroundTypePeer::RANK);
    $this->groundtypes = GroundTypePeer::doSelectWithI18n($c, 'es'); 

    $this->mm = MmPeer::retrieveByPk($mm_id); 
    $this->grounds_sel = $this->mm->getGrounds();
    $this->grounds = GroundPeer::doSelectWithI18n(new Criteria(), 'es');

    return $this->renderPartial('edit_ground');
  }


  /**
   * --  PASTE -- /editar.php/mms/paste
   *
   * Parametros por URL: identificador de la serie donde se pegan
   *
   */
  public function executePaste()
  {
    $serial = SerialPeer::retrieveByPKWithI18n($this->getRequestParameter('serial'), $this->getUser()->getCulture());
    $this->forward404Unless($serial);

    $mms = MmPeer::retrieveByPKs($this->getUser()->getAttribute('cut_mms'));
    foreach($mms as $mm){
      $mm->setSerial($serial);
      $mm->setRank($serial->countMms() + 1);
      $mm->save();
    }
      
    $this->msg_alert = array('info', "Objetos multimedia pegados en la serie.");

    return $this->renderComponent('mms', 'list');
  }

  /**
   * --  CUT -- /editar.php/mms/cut
   *
   * Parametros por POST: lista en json de los identificadores de los mm a cortar
   *
   */
  public function executeCut()
  {
    $this->getUser()->setAttribute('cut_mms', json_decode($this->getRequestParameter('ids')));
    $this->msg_alert = array('info', "Objetos multimedia cortados, péguelos en las serie que desee.");

    return $this->renderComponent('mms', 'list');
  }
  

}



