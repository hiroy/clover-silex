<?php
namespace Clover\Silex\Util;

use Symfony\Component\HttpFoundation\Request;

class Pager
{
    const PAGE_PARAM_NAME = 'page';

    protected $page = 1;
    protected $limit = 10;
    protected $offset = 0;
    protected $hasNextPage = false;
    protected $baseRequestUri;
    protected $baseQueryStrings = [];

    public function __construct(Request $request, $limit = 10)
    {
        $page = $request->query->get(self::PAGE_PARAM_NAME, 1);
        if (!ctype_digit($page)) {
            $page = 1;
        }

        $this->page = $page;
        $this->limit = $limit;
        $this->offset = ($page - 1) * $limit;

        $this->baseRequestUri = $request->getRequestUri();
        if (($pos = strpos($this->baseRequestUri, '?')) !== false) {
            $this->baseRequestUri = substr($this->baseRequestUri, 0, $pos);
        }
        $this->baseQueryStrings = $request->query->all();
        if (isset($this->baseQueryStrings[self::PAGE_PARAM_NAME])) {
            unset($this->baseQueryStrings[self::PAGE_PARAM_NAME]);
        }
    }

    public function setContents(array &$data)
    {
        if (count($data) > $this->limit) {
            array_pop($data);
            $this->hasNextPage = true;
        } else {
            $this->hasNextPage = false;
        }
    }

    public function getQueryLimit()
    {
        return $this->limit + 1;
    }

    public function getQueryOffset()
    {
        return $this->offset;
    }

    public function hasPager()
    {
        return $this->page > 1 || $this->hasNextPage;
    }

    public function getPreviousUrl()
    {
        $previousUrl = null;
        if ($this->page > 1) {
            $previousUrl = $this->createPagerUrl($this->page - 1);
        }
        return $previousUrl;
    }

    public function getNextUrl()
    {
        $nextUrl = null;
        if ($this->hasNextPage) {
            $nextUrl = $this->createPagerUrl($this->page + 1);
        }
        return $nextUrl;
    }

    public function getPagerUrls()
    {
        $pagerUrls = [];
        if ($this->page > 2) {
            $pagerUrls[] = [
                'page' => $this->page - 2,
                'url' => $this->createPagerUrl($this->page - 2),
            ];
        }
        if ($this->page > 1) {
            $pagerUrls[] = [
                'page' => $this->page - 1,
                'url' => $this->createPagerUrl($this->page - 1),
            ];
        }
        $pagerUrls[] = [
            'page' => $this->page,
            'url' => null,
        ];
        if ($this->hasNextPage) {
            $pagerUrls[] = [
                'page' => $this->page + 1,
                'url' => $this->createPagerUrl($this->page + 1),
            ];
        }
        return $pagerUrls;
    }

    protected function createPagerUrl($page)
    {
        $pagerUrl = $this->baseRequestUri;
        $queryStrings = $this->baseQueryStrings;
        if ($page > 1) {
            $queryStrings[self::PAGE_PARAM_NAME] = $page;
        }
        if (count($queryStrings) > 0) {
            $pagerUrl .= '?' . http_build_query($queryStrings);
        }
        return $pagerUrl;
    }
}
