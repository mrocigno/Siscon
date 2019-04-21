<?php


namespace App\ModelsVO;

class PrintVO {

    private $service;
    private $status;
    private $photos;

    /**
     * PrintVO constructor.
     * @param $service
     * @param $status
     * @param $photos
     */
    public function __construct($service, $status, $photos)
    {
        $this->service = $service;
        $this->status = $status;
        $this->photos = $photos;
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



}