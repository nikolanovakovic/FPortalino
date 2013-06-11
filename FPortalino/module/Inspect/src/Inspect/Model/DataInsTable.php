<?php

namespace Inspect\Model;

use Inspect;
use ZfTable\AbstractTable;

class DataInsTable extends AbstractTable
{

    //Definition of headers
    protected $headers = array(
        'IDInspectionTable' => array('title' => 'Id', 'width' => '50'),
        'proba_text' => array('title' => 'Proba teksta'),
        'proba_broj' => array('title' => 'Proba broja'),
        'proba_email' => array('title' => 'Proba emaila'),
       /* 'city' => array('title' => 'City'),
        'active' => array('title' => 'Active'),*/
    );

    public function init()
    {
        //Table attributes
        $this->addAttr('id', 'inspection_table');
        $this->addClass('display');
    }

    /**
     * Initializable where quick search
     */
    public function initQuickSearch()
    {
        $quickSearchValue = $this->getParamAdapter()->getQuickSearch();
        $quickSearchQuery = new \Zend\Db\Sql\Select();

        if (strlen($quickSearchValue)) {
            //Unsecure query (without quote)
            $quickSearchQuery->where('name like "%' . $quickSearchValue . '%"');
            $this->getSource()->setQuickSearchQuery($quickSearchQuery);
        }
    }

}
