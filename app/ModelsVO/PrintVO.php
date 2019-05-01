<?php


namespace App\ModelsVO;

class PrintVO {

    private $service;
    private $status;
    private $photos;
    private $structure;

    /**
     * PrintVO constructor.
     * @param $service
     * @param $status
     * @param $photos
     */
    public function __construct($service, $status, $photos, $structure)
    {
        $this->service = $service;
        $this->status = $status;
        $this->photos = $photos;
        $this->structure = $structure;
    }


    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param mixed $photos
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;
    }

    /**
     * @return mixed
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * @param mixed $structure
     */
    public function setStructure($structure)
    {
        $this->structure = $structure;
    }

}