<?php

abstract class Api
{
    protected $format;
    protected $queryFormat;
    protected $objectFetched;
    protected $fieldsSearch;
    protected $fieldsFetch;

    /**
     * Api constructor.
     * @param $queryFormat
     * @param string $format
     * @param $objectFetched
     */
    public function __construct($queryFormat, $format = 'json', $objectFetched)
    {
        $this->format = $format;
        $this->queryFormat = $queryFormat;
        $this->objectFetched = $objectFetched;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function getResults($query) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->url.$this->queryFormat.$query);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl);

        curl_close($curl);

        return $output;
    }

    /**
     * @param $authorName
     * @param int $limit
     * @return array
     */
    public function getBooksByAuthor($authorName, $limit = 10)
    {
        $return = [];
        $output = $this->getResults($this->fieldsSearch['author'].$authorName.'&maxResults='.$limit);

        if($this->format == 'json') {
            $return = $this->exportJson($output);
        }

        return $return;
    }

    /**
     * @param $year
     * @param int $limit
     * @return array
     */
    public function getBooksByPublishedYear($year, $limit = 10)
    {
        $return = [];
        $output = $this->getResults($this->fieldsSearch['publishedDate'].$year.'&maxResults='.$limit);

        if($this->format == 'json') {
            $return = $this->exportJson($output);
        }

        return $return;
    }

    abstract protected function exportJson($output);

}