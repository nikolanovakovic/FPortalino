<?php


namespace Inspect\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class InspectTable extends AbstractTableGateway {


	protected $table = 'inspection_table';


	public function __construct(Adapter $adapter) {
		$this->adapter = $adapter;
		$this->resultSetPrototype = new ResultSet();
		$this->resultSetPrototype->setArrayObjectPrototype(new Inspect());

		$this->initialize();
	}


	public function fetchAllSelect(){
		$sql = new Sql($this->adapter);

		$select = $sql->select();
		$select->from('Inspect')
		->columns(array('*'))
		;

		return $select;

	}

	public function fetchAll(Select $select = null) {
		if (null === $select)
			$select = new Select();
		$select->from($this->table);
		$resultSet = $this->selectWith($select);
		$resultSet->buffer();
		return $resultSet;
	}


	public function getInspect($id) {
		$id = (int) $id;
		$rowset = $this->select(array('IDInspectionTable' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}


	public function saveInspect(Inspect $inspect) {
		$data = array(
				'proba_text' => $inspect->proba_text,
				'proba_broj' => $inspect->proba_broj,
		        'proba_email' => $inspect->proba_email,
		);

		$id = (int) $inspect->id;
		if ($id == 0) {
			$this->insert($data);
		} else {
			if ($this->getInspect($id)) {
				$this->update($data, array('IDInspectionTable' => $id));
			} else {
				throw new \Exception('Form id does not exist');
			}
		}
	}


	public function deleteInspect($id) {
		$this->delete(array('IDInspectionTable' => $id));
	}

}
