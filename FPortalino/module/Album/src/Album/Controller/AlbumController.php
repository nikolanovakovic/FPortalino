<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Album for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/*
 * Ovo da pri kreiranju modula kao zend item-a
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AlbumController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /album/album/foo
        return array();
    }
}
*/



namespace Album\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album;
use Album\Form\AlbumForm;
use  SynergyDataGrid\Grid\JqGrid ;
use  SynergyDataGrid\Grid\JqGridFactory ;



class AlbumController extends AbstractActionController
{
	protected $albumTable;
	

	public function indexAction()
	{
		return new ViewModel(array(
				'albums' => $this->getAlbumTable()->fetchAll(),
		));
	}

	public function fooAction()
	{
		// This shows the :controller and :action parameters in default route
		// are working when you browse to /album/album/foo
		return array();
	
	}
	
	
	public function addAction()
	{
		$form = new AlbumForm();
		$form->get('submit')->setAttribute('value', 'Add');


		$request = $this->getRequest();
		if ($request->isPost()) {
			$album = new Album();
			$form->setInputFilter($album->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$album->exchangeArray($form->getData());
				$this->getAlbumTable()->saveAlbum($album);


				// Redirect to list of albums
				return $this->redirect()->toRoute('album');
			}
		}


		return array('form' => $form);
	}


	public function editAction()
	{
		$id = (int)$this->params('id');
		if (!$id) {
			return $this->redirect()->toRoute('album', array('action'=>'add'));
		}
		$album = $this->getAlbumTable()->getAlbum($id);


		$form = new AlbumForm();
		$form->bind($album);
		$form->get('submit')->setAttribute('value', 'Edit');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$this->getAlbumTable()->saveAlbum($album);


				// Redirect to list of albums
				return $this->redirect()->toRoute('album');
			}
		}


		return array(
				'id' => $id,
				'form' => $form,
		);
	}


	public function deleteAction()
	{
		$id = (int)$this->params('id');
		if (!$id) {
			return $this->redirect()->toRoute('album');
		}


		$request = $this->getRequest();
		if ($request->isPost()) {
			$del = $request->getPost()->get('del', 'No');
			if ($del == 'Yes') {
				$id = (int)$request->getPost()->get('id');
				$this->getAlbumTable()->deleteAlbum($id);
			}


			// Redirect to list of albums
			return $this->redirect()->toRoute('album');
		}


		return array(
				'id' => $id,
				'album' => $this->getAlbumTable()->getAlbum($id)
		);
	}


	public function getAlbumTable()
	{
		if (!$this->albumTable) {
			$sm = $this->getServiceLocator();
			$this->albumTable = $sm->get('Album\Model\AlbumTable');
		}
		return $this->albumTable;
	}

	
	public function probaAction()
	{
		// This shows the :controller and :action parameters in default route
		// are working when you browse to /album/album/foo
	    //***  Dodala  iz drugog primera
	    
		return array();
		
	/*	foreach ($this->getAlbumTable()->fetchAll() as $album) {
			$albums[] = $album;
		}
		
		$result = new JsonModel(array(
				'albums' => $albums,
				'success'=>true,
		));
		return $result;*/
	}	
	
	
	/*public function gridAction()
	{
		//replace {Entity_Name} with your entity name e.g. 'Application\Entity\User'
	
		$serviceManager = $this->getServiceLocator() ;
		$grid = $serviceManager->get('jqgrid')
		->create({Entity_Name});
	
		$grid->setToolbar = array(true, 'bottom'); //optional
		$grid->setToppager = true; //optional
	
		$grid->render();
	
		return array('grid' => $grid);
	
	}*/
	
	public function gridAction()
	{
		//replace {Entity_Name} with your entity name e.g. 'Application\Entity\User'
		$serviceManager = $this->getServiceLocator();
		$grid = $serviceManager->get('jqgrid')->setGridIdentity(Album);
		/**
		 * this is the url where CRUD operations would be done via ajax
		 * :entity in the editurl could be any identifier or id.  You would need to
		 * retrieve this and get the FQCN for use by the entity manager
		 * e.g. :entity = $this->getEntityKey({Entity_Name});
		 * @ see crudAction()
		*/
		$url  = '/album[/:action][/:id]';            //   /ajax/:entity;
		$grid->setUrl($url);
		$grid->setCaption('My Caption'); //optional
	
		return array('grid' => $grid);
	
	}
	public function crudAction()
	{
		$response  = '';
		/**
		 * Assumes that the entity can be retrieved from the ajax request
		 * e.g /ajax/:entity
		 * implement function to get the FQCN from :entity
		 */
		$entity = $this->params()->fromRoute('action', null);  //entity
		$className = $this->getClassname($action);    //entity
	
		if ( $className) {
			$serviceManager = $this->getServiceLocator();
			$grid = $serviceManager->get('jqgrid')->setGridIdentity( $className);
			$response = $grid->prepareGridData();
		}
	
		return new JsonModel($response);
	}
	
	public function getEntityClassname($entityKey){
		//@TODO implement as required
		//return $entityClassname ;
	}
	
	public function getEntityKey($className){
		//@TODO implement as required ;
		//return $entity;
	}
	
	
		
}

