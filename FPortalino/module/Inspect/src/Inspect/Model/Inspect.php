<?php
namespace Inspect\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Inspect implements InputFilterAwareInterface
{
	public $IDInspectionTable;
	public $proba_text;
	public $proba_broj;
	public $proba_email;

	protected $inputFilter;

	/**
	 * Used by ResultSet to pass each database row to the entity
	 */
	public function exchangeArray($data)
	{
		$this->IDInspectionTable     = (isset($data['IDInspectionTable'])) ? $data['IDInspectionTable'] : null;
		$this->proba_text = (isset($data['proba_text'])) ? $data['proba_text'] : null;
		$this->proba_broj  = (isset($data['proba_broj'])) ? $data['proba_broj'] : null;
		$this->proba_email  = (isset($data['proba_email'])) ? $data['proba_email'] : null;
	}

	public function getArrayCopy()
	{
		return get_object_vars($this);
	}

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}

	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();

			$factory = new InputFactory();

			$inputFilter->add($factory->createInput(array(
					'name'     => 'IDInspectionTable',
					'required' => true,
					'filters'  => array(
							array('name' => 'Int'),
					),
			)));

			$inputFilter->add($factory->createInput(array(
					'name'     => 'proba_text',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			)));

			$inputFilter->add($factory->createInput(array(
					'name'     => 'proba_broj',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			)));

			$inputFilter->add($factory->createInput(array(
					'name'     => 'proba_email',
					'required' => true,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min'      => 1,
											'max'      => 100,
									),
							),
					),
			)));
				
			
			$this->inputFilter = $inputFilter;
		}

		return $this->inputFilter;
	}
}
