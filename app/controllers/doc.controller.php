<?php
require_once APP_ROOT . '/app/services/Doc.services.php';
require_once APP_ROOT . '/app/models/Doc.models.php';
class DocController
{
  public function index()
  {
    $docService = new DocService();
    $docList = $docService->getAllDoc();
    include APP_ROOT . '/app/views/home/index.view.php';
  }
  public function add()
  {
    require_once APP_ROOT .'/app/views/doc/add.view.php';
  }
  public function store()
  {
    $tenxe = $_POST['tenxe'];
    $tacgia = $_POST['tacgia'];
    $mota = $_POST['mota'];
    $doc = new Doc(null, $tenxe, $tacgia, $mota);
    $docService = new DocService();
    $docService->addDoc($doc);
    header('Location:?controller=home');
  }
  public function edit($maxe){
  echo ($maxe);
    if(isset($maxe)){
      $docService = new DocService();
      $doc=$docService->getDocById($maxe);
      include APP_ROOT . '/app/views/doc/edit.view.php';
    }
    else{
      echo'ma hang is null';
    }
  }
  public function editPost($maxe){
    $tenxe= $_POST['tenxe'];
    $tacgia= $_POST['tacgia'];
    $mota= $_POST['mota'];
    $doc = new Doc($maxe, $tenxe, $tacgia, $mota);
    $docService = new DocService();
    $docService->editDoc($doc);
    header('Location: ?controller=home');
  }

  public function delete($maxe){
    if(isset($maxe)){
      $docService = new DocService();
      $doc=$docService->getDocById($maxe);
      include APP_ROOT . '/app/views/doc/delete.view.php';
    }
    else{
      echo'Id is null';
    }
  }
  public function deletePost($maxe){
    $docService = new DocService();
    $docService->deleteDoc($maxe);
    header('Location: ?controller=home');

  }
}
