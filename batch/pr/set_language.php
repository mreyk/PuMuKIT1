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

//echo "START 1\n\n\n";
if(count($argv) != 3){
  echo "ERROR DE PARAMETROS\n";
  exit;
}

$file = FilePeer::retrieveByPK($argv[1]);
if(is_null($file)){
  echo "ERROR DE FILE\n";
  exit;
}

$language = LanguagePeer::retrieveByPK($argv[2]);
if(is_null($language)){
  echo "ERROR DE LANGUAGE\n";
  exit;
}

$file->setLanguage($language);
$file->save();