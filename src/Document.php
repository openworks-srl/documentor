<?php
namespace App;


class Document
{
    
    private $file;
    private $name;
    private $format;
    private $contentType;
    private $lenght;
    
    
    public function saveAs( $path , $override) {
        if ($this->file != null && file_exists($this->file)) {
            if ($override || !file_exists($path)) {
                copy($this->file, $path);
                cleanUp();
            } else {
                throw new \Exception("Il file specificato $path esiste gia'");
            }
        } else {
            throw new \Exception("E' possibile salvare il file una sola volta");
        }
        
    }
    
    public function send() {
      if ($this->file != null && file_exists($this->file)) {
        header("Content-Type: ".$this->contentType);
        header('Content-disposition: filename="'.$this->name.$this->format.'"');
        header('Content-Length', $this->lenght);
        readfile($this->file);
        cleanUp();
    } else {
        throw new \Exception("E' possibile inviare il file una sola volta");
    }
    }
    
    private function cleanUp() {
       unlink($this->file);
       unset($this->file);
    }
    
    
    
    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    public function getContentType()
    {
        return $this->contentType;
    }

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }

    public function getLenght()
    {
        return $this->lenght;
    }

    public function setLenght($lenght)
    {
        $this->lenght = $lenght;
        return $this;
    }

    
    
    
}

