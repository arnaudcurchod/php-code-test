<?php

class ItBookStoreApi extends Api {

    protected $url = 'https://api.itbook.store/1.0';
    protected $fieldsSearch;

    /**
     * ItBookStore constructor.
     * @param $queryFormat
     * @param string $format
     * @param $objectFetched
     */
    public function __construct($queryFormat, $format = 'json', $objectFetched)
    {
        parent::__construct($queryFormat, $format, $objectFetched);
        $this->fieldsSearch = [
            'author' => '',
            'publishedDate' => '',
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
                    'title'    => $result->title,
                    'subtitle'    => $result->subtitle,
                    'isbn13'    => $result->isbn13,
                    'price'    => $result->price,
                    'image'    => $result->image,
                    'url'    => $result->url,
                ];
            }
        }

        return $return;
    }
}