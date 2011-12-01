<?php // $Id: csv.class.php 13377 2011-07-29 10:27:11Z abourguignon $

FromKernel::uses('csvexporter.class');

/**
 * CLAROLINE
 *
 * CSV class.
 *
 * This class will be correctly implemented soon, within CsvExporter and
 * CsvImporter classes.
 * Meanwhile, it will just act as a patch solution.
 *
 * @version     $Revision: 13377 $
 * @copyright   (c) 2001-2011, Universite catholique de Louvain (UCL)
 * @license     http://www.gnu.org/copyleft/gpl.html (GPL) GENERAL PUBLIC LICENSE
 * @package     KERNEL
 * @author      Claro Team <cvs@claroline.net>
 */

class Csv extends CsvExporter
{
    public $recordList = array();
    
    public function __construct($delimiter = ',', $quote = '"')
    {
        parent::__construct($delimiter, $quote);
    }
    
    /**
     * Alias for the constructor.
     *
     * @deprecated
     */
    public function csv($delimiter = ',', $quote = '"')
    {
        self::__construct($delimiter, $quote);
    }
    
    /**
     * Alias for parent's method export().
     *
     * @deprecated
     */
    public function export()
    {
        return parent::export($this->recordList);
    }
}