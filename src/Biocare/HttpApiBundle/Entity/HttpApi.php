<?php

namespace Biocare\HttpApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class HttpApi
{
   private $url;
   private $username;
   private $password;
   private $response; 
   
   public function getUrl() {
       return $this->url;
   }

   public function getUsername() {
       return $this->username;
   }

   public function getPassword() {
       return $this->password;
   }

   public function getResponse() {
       return $this->response;
   }

   public function setUrl($url) {
       $this->url = $url;
       return $this;
   }

   public function setUsername($username) {
       $this->username = $username;
       return $this;
   }

   public function setPassword($password) {
       $this->password = $password;
       return $this;
   }

   public function setResponse($response) {
       $this->response = $response;
       return $this;
   }

   
}
