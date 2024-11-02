<?php
class Doc
{
  private $maxe;
  private $ten;
  private $soseri;
  private $namsanxuat;

  public function __construct($maxe, $ten, $soseri, $namsanxuat)
  {
    $this->maxe = $maxe;
    $this->ten = $ten;
    $this->soseri = $soseri;
    $this->namsanxuat = $namsanxuat;
  }
  public function getMaXe()
  {
    return $this->maxe;
  }
  public function getTenXe()
  {
    return $this->ten;
  }
  public function getSoSeri()
  {
    return $this->soseri;
  }
  public function getNamSanXuat()
  {
    return $this->namsanxuat;
  }
  public function setTenXe($ten)
  {
    $this->tenxe = $ten;
  }
  public function setSoSeri($soseri)
  {
    $this->soseri = $soseri;
  }
  public function setNamSanXuat($namsanxuat)
  {
    $this->namsanxuat = $namsanxuat;
  }
}
