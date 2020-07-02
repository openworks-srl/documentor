<?php
/*
 * Copyright 2019 Openworks srl
 *
 * This file is part of the openworks-srl/documentor package.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * A copy of the License is distributed with the software,
 * if you can't find it, you may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */
namespace Openworks\Documentor;

use function App\Document\cleanUp;

class Document
{
    
    private $file;
    
    private $name;
    
    private $format;
    
    private $contentType;
    
    private $lenght;
    
    public function saveAs($path, $name = null, $override = false)
    {
        if ($name == null) {
            $name = $this->name;
        }
        if (substr($path, -1) != "/" && substr($path, -1) != "/") {
            $path.="/";
        }
        if (! file_exists($path)) {
            throw new \Exception("Impossibile trovare il percorso di destinazione specificato");
        }
        $completePath = $path . $name . '.' . $this->format;
        if ($this->file != null && file_exists($this->file)) {
            if (($override && file_exists($completePath)) || ! file_exists($completePath)) {
                copy($this->file, $completePath);
                $this->cleanUp();
                return $completePath;
            } else {
                throw new \Exception("Il file specificato $path esiste gia'");
            }
        } else {
            throw new \Exception("E' possibile salvare il file una sola volta");
        }
    }
    
    public function send($name = null)
    {
        if ($name == null) {
            $name = $this->name;
        }
        if ($this->file != null && file_exists($this->file)) {
            header("Content-Type: " . $this->contentType);
            header('Content-disposition: filename="' . $name . "." .  $this->format . '"');
            header('Content-Length: ' . $this->lenght);
            readfile($this->file);
            $this->cleanUp();
        } else {
            throw new \Exception("E' possibile inviare il file una sola volta");
        }
    }
    
    private function cleanUp()
    {
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
    
    public function getFullName()
    {
        return $this->name . "." . $this->format;
    }
}

