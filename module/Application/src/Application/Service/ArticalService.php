<?php

namespace Application\Service;

class ArticalService extends AbstractEntityService
        implements EntityServiceInterface
{

    protected $_entity = 'Application\Entity\Artical';

    public function getList()
    {
    	
         return $this->getRepository()->findAll(array(), array('id' => 'DESC'));
    }

}
