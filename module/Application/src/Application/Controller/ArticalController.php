<?php

namespace Application\Controller;

use Application\Controller\ArticalController;
use Zend\View\Model\ViewModel;
//use Application\Form\UserReviewForm;

class ArticalController extends AbstractController
{

    public function indexAction()
    {
    	
        $service = $this->getServiceLocator()->get('ArticalService');
        //print_r($service);
        $artical = $service->getList();
      
     //  var_dump($artical); die();
        return new ViewModel(['articals' => $artical]);
    }

    public function addAction()
    {

        $service = $this->getServiceLocator()->get('ArticalService');
        $form = new UserReviewForm;

        if ($this->request->isPost()) {

            $form->setData($this->request->getPost());
            if ($form->isValid()) {
                $review = new \Application\Entity\UserReview($form->getData());

                $service->save($review, true);

                $this->redirect()->toRoute('home', ['controller' => 'review',
                    'action' => 'index']);
            }
        }

        return new ViewModel(['form' => $form]);
    }

}
