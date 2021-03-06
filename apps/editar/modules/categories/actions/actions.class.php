<?php

/**
 * MODULO CATEGORY ACTIONS. 
 * Modulo de administracion de las rols que estan asociadas a algun
 * objeto multimedia del catalogo. 
 *
 * @package    pumukit
 * @subpackage category
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class categoriesActions extends sfActions
{

  /**
   * --  INDEX -- /editar.php/categories
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('config_menu','active');
    $this->root = CategoryPeer::doSelectRoot();
  }


  /**
   * --  LIST -- /editar.php/categories/list
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('categories', 'list');
  }


  /**
   * --  CHILDREN -- /editar.php/categories/children
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeChildren()
  {
    $parent = CategoryPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($parent);

    $this->parent_id = $parent->getId();
    $this->categories = $parent->getChildren();
    $this->level = ($this->getRequestParameter('level', 1)) + 1 ; 

    $this->class_name = "d_" .$parent->getId() . " c_".$parent->getId();
    foreach($parent->getPath() as $p) {
      $this->class_name .= (" c_" . $p->getId());
    }
    
  }


  /**
   * --  CREATE -- /editar.php/categories/create
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->category = new Category();

    $this->parent_id = $this->getRequestParameter('parent_id');
    $parent = CategoryPeer::retrieveByPk($this->parent_id);
    $this->forward404Unless($parent);
    $this->category->insertAsLastChildOf($parent);

    $this->langs = sfConfig::get('app_lang_array', array('es'));
    $this->action = ($this->hasRequestParameter("root"))?"create_root":"create";

    $this->setTemplate('edit');
  }

  /**
   * --  EDIT -- /editar.php/categories/edit/id/?
   *
   * Accion asincrona. Acceso privado. Parametros id por URL, role y mm opcionales, (para conocer que template usar)
   *
   */
  public function executeEdit()
  {
    $this->category = CategoryPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->category);
    $this->parent_id = $this->category->getParent()->getId();

    $this->langs = sfConfig::get('app_lang_array', array('es')); 
    $this->action = "edit";
  }


  /**
   * --  UPDATE -- /editar.php/categories/update
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $category = new Category();
      $parent_id = $this->getRequestParameter('parent_id');
      $parent = CategoryPeer::retrieveByPk($parent_id);
      $this->forward404Unless($parent);
      $category->insertAsLastChildOf($parent);
    }
    else
    {
      $category = CategoryPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($category);
    }

    $category->setMetacategory($this->getRequestParameter('metacategory', false));
    $category->setDisplay($this->getRequestParameter('display', true));

    //
    //No funciona. Funcion setRequired está mal sobrecargada (ver lib/model/Category.php).
    //$category->setRequired($this->getRequestParameter('required'));
    //

    $category->setCod($this->getRequestParameter('cod', ' '));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $category->setCulture($lang);
      $category->setName($this->getRequestParameter('name_'. $lang, ' '));
    }
    $category->save();
      
    $this->getUser()->setAttribute('id', $category->getId(), 'tv_admin/category');

    return $this->renderText($category->getCodName());
  }

  /**
   * --  DELETE -- /editar.php/categories/delete
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $categories = array_reverse(CategoryPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids'))));

      foreach($categories as $category){
	if(0 != count($category->getChildren())) $this->forward404();
	$category->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $category = CategoryPeer::retrieveByPk($this->getRequestParameter('id'));
      if(0 != count($category->getChildren())) $this->forward404();
      $category->delete();
    }

    $this->msg_alert = array('info', "Rol borrado.");
    return $this->renderComponent('categories', 'list');
  }


  /**
   * --  SHOWRELATIONS -- /editar.php/categories/showrelations
   *
   */
  public function executeShowrelations()
  {
    $this->category = CategoryPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->category);

    $aux = CategoryPeer::buildTreeArray();
    $this->categories = $aux[0][CategoryPeer::TREE_ARRAY_CHILDREN];

    $this->relations = RelationCategoryPeer::doSelect(new Criteria());
  }


  /**
   * --  CHANGECATEGORY -- /editar.php/categories/changecategory
   *
   */
  public function executeChangecategory()
  {
    $this->mainc = CategoryPeer::retrieveByPk($this->getRequestParameter('oneid'));
    $this->forward404Unless($this->mainc);

    $this->c = CategoryPeer::retrieveByPk($this->getRequestParameter('twoid'));
    $this->forward404Unless($this->c);

    $c = new Criteria();
    $c->add(RelationCategoryPeer::ONE_ID, $this->mainc->getId());
    $c->add(RelationCategoryPeer::TWO_ID, $this->c->getId());
    RelationCategoryPeer::doDelete($c);

    if(in_array($this->getRequestParameter('value'), array('rec', 'aso'))){
      $rel = new RelationCategory();
      $rel->setOneId($this->mainc->getId());
      $rel->setTwoId($this->c->getId());
      $rel->setRecommended(($this->getRequestParameter('value') == 'rec'));
      $rel->save();      
    }
    
    return sfView::NONE;
  }
  


}
