<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 28/07/16
 * Time: 17:01
 */

namespace Cz\ManagerBundle\Helper\Piwik;

class PiwikAPI {

    public $url = 'https://nlefebvre1410.piwik.pro/index.php?module=API';
    public $siteId = 1;
    public $token = "99abd09eb99a15d378664841ed78e65e";
    public $format = "xml";
    public $methods = array('visitsSummary' => 'VisitsSummary.get', 'visitsSummaryHour' => 'VisitTime.getVisitInformationPerServerTime');

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * getVisitsByRange : get the visits of piwik by visits type and range
     * @parameter visit : all | uniq
     * @parameter range : hour | year | day | month
     * @result : json with visit and visit uniq total count and a array of all data by date
     */
    public function getVisitsByRange($visit = 'all', $range = 'hour')
    {

        if (!in_array($range, array('hour', 'year', 'day', 'month')))
        {
            throw new Exception($range." is not a valid parameter");
        }

        list($date, $period, $format) = $this->getDateAndPeriod($range);

        $method = ($range == 'hour') ? $this->methods['visitsSummaryHour'] : $this->methods['visitsSummary'];
        $xml = new \SimpleXMLElement(file_get_contents($this->prepareUrl($method, $date, $period)));
        $results = ($range == 'hour') ? $xml->row : $xml->result;

        $return  = array();
        $sumAll  = 0;
        $sumUniq = 0;

        if ($range == 'hour') {
            for ($i = 0; $i <= 23; $i++) {
                $return[$i.""] = 0;
            }
        }


        foreach ($results as $result)
        {

            if (isset($result->nb_uniq_visitors))
            {
                $value   = $result->nb_uniq_visitors.'';
                $sumUniq += $result->nb_uniq_visitors + 0;
                $sumAll  += $result->nb_visits + 0;

                if ($visit == 'all')
                {
                    $value = $result->nb_visits.'';
                }

                $index = ($range == 'hour') ? $result->label.'' : (new \DateTime($result['date']))->format($format);
                $return[$index] = $value;
            }
            else {
                $return[(new \DateTime($result['date']))->format($format)] = 0;
            }
        }

        $returnSum = array($sumAll, $sumUniq);
        return json_encode(array($return, $returnSum));

    }


    private function prepareUrl($method, $date, $period)
    {
        return $this->url."&method=".$method."&idSite=".$this->siteId."&date=".$date."&period=".$period."&format=".$this->format."&token_auth=".$this->token;
    }

    /**
     * @param string $range
     * @return array
     */
    private function getDateAndPeriod($range = 'hour')
    {

        if ($range == 'year')
        {
            $date = (new \DateTime('now'))->format('Y').'-01-01';
            $end = (new \DateTime('now'))->format('Y').'-12-31';
            $date = $date.",".$end;
            $period = "month";
            $format = 'm/y';
        }
        if ($range == 'day')
        {
            $monday =  date("Y-m-d", strtotime(date('o-\\WW')));
            $sunday =  (new \DateTime($monday.' + 6 days'))->format('Y-m-d');
            $date = $monday.",".$sunday;
            $period = 'day';
            $format = 'd/m';
        }
        if ($range == 'month')
        {
            $date = (new \DateTime('now'))->format('m/y');
            $date = (new \DateTime($date))->format('Y-m').'-01';
            $end = (new \DateTime($date))->format('Y-m').'-31';
            $format = 'd/m/y';
            $date = $date.",".$end;
            $period = 'day';
        }
        if ($range == 'hour')
        {
            $date = 'today';
            $period = 'day';
            $format = '';
        }

        return array($date, $period, $format);
    }



}