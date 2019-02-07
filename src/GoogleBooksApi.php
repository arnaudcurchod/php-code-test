<?php

 class GoogleBooksApi extends Api {

    protected $url = 'https://www.googleapis.com/books/v1/volumes';
    protected $fieldsSearch;

    /**
     * GoogleBooksApi constructor.
     * @param $queryFormat
     * @param string $format
     * @param $objectFetched
     */
    public function __construct($queryFormat, $format = 'json', $objectFetched)
    {
        parent::__construct($queryFormat, $format, $objectFetched);
        $this->fieldsSearch = [
            'author' => 'inauthor:',
            'publishedDate' => 'inpublisher:',
            'title' => ''
        ];
    }

    /**
     * @param $output
     * @return array
     */
    public function exportJson($output) {
        $return = [];

        $json = json_decode($output);

        if(isset($json->{$this->objectFetched})) {
            foreach ($json->{$this->objectFetched} as $result) {
                $return[] = [
                    'title'    => $result->volumeInfo->title,
                    'author' => $result->volumeInfo->authors,
                    'isbn' => $result->volumeInfo->industryIdentifiers,
                ];
            }
        }

        return $return;
    }
}