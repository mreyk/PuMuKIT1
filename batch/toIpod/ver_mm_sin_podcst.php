<?php

/**
 * profile batch script
 *
 * Script que elementos que tiene relaciones rotas.
 * (Objetos multimedia sin series; Archivos de video, Materiales,
 * Links, Areas de Conocimiento y Personas que no tienen Objetos Multimedia)
 *
 * @package    pumukituvigo
 * @subpackage batch
 * @version    1
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here

echo "START 1\n\n\n";


$c = new Criteria();
$mms = MmPeer::doSelectWithI18n($c);

$i = 0;
foreach($mms as $mm){
  $perfiles = $mm->getPerfilIds();


  if(in_array(1, $perfiles)){
    if(!in_array(21, $perfiles)){
      echo $mm->getId() . "\t" . $mm->getTitle() . "\t" . count($perfiles) ."\n";
      var_dump($perfiles);
      $i++;
    }
  }
  //  echo "\n\n\n";
    
}


echo $i;