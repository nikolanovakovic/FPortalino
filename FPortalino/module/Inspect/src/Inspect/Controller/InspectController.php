<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Inspect for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Inspect\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use  SynergyDataGrid\Grid\JqGridFactory ;

/*class InspectController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /inspect/inspect/foo
        return array();
    }
}*/

/*namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
//use Zend\View\Model\ViewModel;*/


use ZfTable\Example\TableExample;
use Inspect\Model;
use Zend\View\Model\ViewModel;
use Zend\Db\ResultSet\ResultSet;
use ZfTable\Params\AdapterDataTables;
use ZfTable\Options\ModuleOptions;
use ZfTable\AbstractTable;
use Inspect\Module;



/**
 * InspectController
 *
 * @author
 * @version
 */
class InspectController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */
	/*public function indexAction() {
		// TODO Auto-generated InspectController::indexAction() default action
	return new ViewModel();
	}*/

   
	/**
	 *
	 * @var ResultSet
	 */
	protected $resultSet;

	/**
	 *
	 * @var
	 */
	protected $inspectTable;

	/**
	 *
	 * @var Zend\Db\Adapter\Adapter
	 */
	protected $dbAdapter;

	/**
	 *
	 * @var ModuleOptions
	 */
	protected $moduleOptions;


	/**
	 * ********* Base *******************
	 * ***********************************
	 */
	public function baseAction()
	{

	}

	public function ajaxBaseAction()
	{
		return $this->getCommonTableAjax(new TableExample\Base());
	}


	/**
	 * ********* Mapper *******************
	 * ***********************************
	 */
	public function mapperAction()
	{

	}

	public function ajaxMapperAction()
	{
		return $this->getCommonTableAjax(new TableExample\Mapper());
	}

	/**
	 * ********* Link *******************
	 * ***********************************
	 */
	public function linkAction()
	{

	}

	public function ajaxLinkAction()
	{
		return $this->getCommonTableAjax(new TableExample\Link());
	}


	/**
	 * ********* Template *******************
	 * ***********************************
	 */
	public function templateAction()
	{

	}

	public function ajaxTemplateAction()
	{
		return $this->getCommonTableAjax(new TableExample\Template());
	}


	/**
	 * ********* Attr *******************
	 * ***********************************
	 */
	public function attrAction()
	{

	}

	public function ajaxAttrAction()
	{
		return $this->getCommonTableAjax(new TableExample\Attr());
	}


	/**
	 * ********* Condition *******************
	 * ***********************************
	 */
	public function conditionAction()
	{

	}

	public function ajaxConditionAction()
	{
		return $this->getCommonTableAjax(new TableExample\Condition());
	}


	/**
	 * ********* Mix *******************
	 * ***********************************
	 */
	public function mixAction()
	{

	}

	public function ajaxMixAction()
	{
		return $this->getCommonTableAjax(new TableExample\Mix());
	}

	/**
	 * ********* Advance *******************
	 * ***********************************
	 */
	public function advanceAction()
	{

	}

	public function ajaxAdvanceAction()
	{
		return $this->getCommonTableAjax(new TableExample\Advance() , 'custom' , 'custom');
	}







	/*     * ********************************************** */
	/*     * ************* EXAMPLE DATA TABLE ************* */

	public function dataTableAction()
	{
		$dataTable = $this->tableDataTable();

		return new ViewModel(array(
				'tableDataTable' => $dataTable,
		));
	}

	public function ajaxDataTableAction()
	{
		$table = $this->tableDataTable();

		$response = $this->getResponse();
		$response->setStatusCode(200);
		$response->setContent($table->render('dataTableJson'));
		return $response;
	}

	/**
	 * Data table (look at setParamAdapter)
	 *
	 * @return \ZfTable\Example\TableExample\DataTable
	 */
	private function tableDataTable()
	{
		$source = $this->getSource();

		//$table = new TableExample\DataTable();
		$table = new Model\DataInsTable();
		$table->setAdapter($this->getDbAdapter())
		->setSource($source)
		->setParamAdapter(new AdapterDataTables($this->getRequest()->getPost()))
		;
		return $table;
	}

	/*     * ********************************************** */
	/*     * ********************************************** */

	protected function getCommonTableAjax(AbstractTable $table, $renderType = 'html', $renderTemplate = null)
	{
		$source = $this->getSource();

		$table->setAdapter($this->getDbAdapter())
		->setSource($source)
		->setOptions($this->getModuleOptions())
		->setParamAdapter($this->getRequest()->getPost())
		;

		$response = $this->getResponse();
		$response->setStatusCode(200);
		$response->setContent($table->render($renderType , $renderTemplate));
		return $response;
	}

	public function getInspectTable()
	{
		if (!$this->inspectTable) {
			$sm = $this->getServiceLocator();
			$this->inspectTable = $sm->get('Inspect\Model\InspectTable');
		}
		return $this->inspectTable;
	}

	public function getModuleOptions()
	{
		if (!$this->moduleOptions) {
			$sm = $this->getServiceLocator();
			$config = $sm->get('Config');
			//$this->moduleOptions = new ModuleOptions(isset($config['zftable']) ? $config['zftable'] : array());
			$this->moduleOptions = new ModuleOptions(isset($config['inspect']) ? $config['inspect'] : array());
		}
		return $this->moduleOptions;
	}

	/**
	 *
	 * @return Zend\Db\Adapter\Adapter
	 */
	public function getDbAdapter()
	{
		if (!$this->dbAdapter) {
			$sm = $this->getServiceLocator();
			$this->dbAdapter = $sm->get('zfdb_adapter');
		}
		return $this->dbAdapter;
	}

	/**
	 *
	 * @return type
	 */
	private function getSource()
	{
		return $this->getInspectTable()->fetchAllSelect();
	}


	public function fooAction()
	{
		// This shows the :controller and :action parameters in default route
		// are working when you browse to /album/album/foo
		return array();
	
	}
///////////////////////////////////////////	
   /* public function gridAction()
    {
        //replace {Entity_Name} with your entity name e.g. 'Application\Entity\User'
        $serviceManager = $this->getServiceLocator() ;
        $grid = $serviceManager->get('jqgrid')->setGridIdentity([Entity_Name]);
        //**
        // * this is the url where CRUD operations would be done via ajax
        // * :entity in the editurl could be any identifier or id.  You would need to
        // * retrieve this and get the FQCN for use by the entity manager
        // * e.g. :entity = $this->getEntityKey({Entity_Name});
        // * @ see crudAction()
        // 
      //  $url  = /ajax/:entity; // '/[:ajax[/:entity]]'; //    /ajax/:entity;
        $grid->setUrl($url);
        $grid->setCaption('My Caption'); //optional

        return array('grid' => $grid);

    }
     public function crudAction()
     {
        $response  = '';
        //**
        // * Assumes that the entity can be retrieved from the ajax request
        // * e.g /ajax/:entity
        // * implement function to get the FQCN from :entity
        // /
        $entity = $this->params()->fromRoute('entity', null);
        $className = $this->getClassname($entity);

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
    }*/

}
