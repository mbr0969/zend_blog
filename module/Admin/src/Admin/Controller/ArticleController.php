<?php
namespace Admin\Controller;
use Application\Controller\BaseAdminController as BaseController;
use Blog\Entity\Arcticle;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Admin\Form\ArticleAddForm;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydraror;


class ArticleController  extends BaseController{

    public function indexAction() {

        $query = $this->getEntityManager()->createQueryBuilder();
        $query->select('a')->from('Blog\Entity\Arcticle', 'a')->orderBy('a.id','DESC');

        //Пагинация
        $adapter = new DoctrineAdapter(new ORMPaginator($query));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(4);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page',1));
        return array('articles'=>$paginator);
    }

    public function addAction(){

        $em= $this->getEntityManager();
        $form = new ArticleAddForm($em);

        $request = $this->getRequest();
        if ($request->isPost()){
            $message = $status ='';

            $data = $request->getPost();

            $article = new Arcticle();
            $form->setHydrator(new DoctrineHydraror($em, '\Arcticle'));
            $form->bind($article);
            $form->setData($data);

            if ($form->isValid()){

                $em->persist($article);
                $em->flush();

                $status = 'success';
                $message = 'Статья добавленна';
            }else{
                $status = 'error';
                $message = 'Ошибка параметров';
                foreach ($form->getInputFilter()->getInvalidInput() as $errors){
                    foreach ($errors->getMessages() as $error){
                        $message .=  ' '. $error;
                    }
                }
            }
        }else {
            return array('form' => $form);
        }

        if ($message) {
            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);
        }
        return $this->redirect()->toRoute('admin/article');

    }

    public function editAction() {
        $message = $status = '';
        $em = $this->getEntityManager();
        $form = new ArticleAddForm($em);

        $id = (int)$this->params()->fromRoute('id', 0);
        $article = $em->find('Blog\Entity\Arcticle', $id);


        if (empty($article)){
            $status = 'error';
            $message = 'Статья не найдена';
            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);
            return $this->redirect()->toRoute('admin/article');
        }

        $form->setHydrator(new DoctrineHydraror($em, '\Arcticle'));
        $form->bind($article);

        $request = $this->getRequest();
        if ($request->isPost()){
            $data = $request->getPost();
            $form->setData($data);
            if ($form->isValid()){
                $em->persist($article);
                $em->flush();

                $status = 'success';
                $message = 'Статья обновленна';
            }else{
                $status = 'error';
                $message = 'Ошибка параметров';
                foreach ($form->getInputFilter()->getInvalidInput() as $errors){
                    foreach ($errors->getMessages() as $error){
                        $message .=  ' '. $error;
                    }
                }
            }

        }else {
            return array('form'=>$form, 'id'=>$id);
        }
        if ($message) {
            $this->flashMessenger()
                ->setNamespace($status)
                ->addMessage($message);
        }
        return $this->redirect()->toRoute('admin/article');
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id',0);
        $em = $this->getEntityManager();

        $status = 'success';
        $message = 'Запись удалена';

        try{
            $repository = $em->getRepository('Blog\Entity\Arcticle');
            $article = $repository->find($id);
            $em->remove($article);
            $em->flush();

        }catch (\Exception $ex){
            $status = 'error';
            $message = 'Ошибка удаление записи: ' . $ex->getMessage();
        }
        $this->flashMessenger()
            ->setNamespace($status)
            ->addMessage($message);
        return $this->redirect()->toRoute('admin/article');

    }

}