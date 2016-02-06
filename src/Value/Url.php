<?php
namespace Bolt\Extension\Ross\URLField\Value;


class Url
{
    /** @var SchemeName */
    protected $scheme;

    /** @var StringLiteral */
    protected $user;

    /** @var StringLiteral */
    protected $password;

    /** @var Domain */
    protected $domain;

    /** @var Path */
    protected $path;

    /** @var PortNumber */
    protected $port;

    /** @var QueryString */
    protected $queryString;

    /** @var FragmentIdentifier */
    protected $fragmentIdentifier;

    /**
     * Returns a new Url object from a native url string
     *
     * @param $url_string
     * @return Url
     */
    public static function fromNative()
    {
        $urlString = \func_get_arg(0);

        $user        = \parse_url($urlString, PHP_URL_USER);
        $pass        = \parse_url($urlString, PHP_URL_PASS);
        $host        = \parse_url($urlString, PHP_URL_HOST);
        $queryString = \parse_url($urlString, PHP_URL_QUERY);
        $fragmentId  = \parse_url($urlString, PHP_URL_FRAGMENT);
        $port        = \parse_url($urlString, PHP_URL_PORT);

        $scheme     = parse_url($urlString, PHP_URL_SCHEME);
        $user       = $user ?: '';
        $pass       = $pass ?: '';
        $domain     = $host;
        $path       = parse_url($urlString, PHP_URL_PATH);
        $portNumber = $port ?: null;
        $query      = $queryString ?: null;
        $fragment   = $fragmentId ?: null;

        return new self($scheme, $user, $pass, $domain, $portNumber, $path, $query, $fragment);
    }

    /**
     * Returns a new Url object
     *
     * @param SchemeName          $scheme
     * @param String              $user
     * @param String              $password
     * @param Domain              $domain
     * @param Path                $path
     * @param PortNumberInterface $port
     * @param QueryString         $query
     * @param FragmentIdentifier  $fragment
     */
    public function __construct($scheme, $user, $password, $domain, $port, $path, $query, $fragment)
    {
        $this->scheme             = $scheme;
        $this->user               = $user;
        $this->password           = $password;
        $this->domain             = $domain;
        $this->path               = $path;
        $this->port               = $port;
        $this->queryString        = $query;
        $this->fragmentIdentifier = $fragment;
    }


    /**
     * Returns the domain of the Url
     *
     * @return Hostname|IPAddress
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Returns the fragment identifier of the Url
     *
     * @return String
     */
    public function getFragmentIdentifier()
    {
        return $this->fragmentIdentifier;
    }

    /**
     * Returns the password part of the Url
     *
     * @return String
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the path of the Url
     *
     * @return String
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the port of the Url
     *
     * @return Int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Returns the query string of the Url
     *
     * @return String
     */
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * Returns the scheme of the Url
     *
     * @return String
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Returns the user part of the Url
     *
     * @return String
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * True if no significant parts are set
     * @return bool
     */
    public function isEmpty()
    {
        return (empty($this->getScheme()) && empty($this->getDomain()) && empty($this->getPath()));

    }

    /**
     * Returns a string representation of the url
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->isEmpty()) {
            return '';
        }

        $userPass = '';
        if ($this->getUser()) {
            $userPass = sprintf('%s@', $this->getUser());

            if ($this->getPassword()) {
                $userPass = sprintf('%s:%s@', $this->getUser(), $this->getPassword());
            }
        }

        $port = '';
        if ($this->getPort()) {
            $port = \sprintf(':%d', $this->getPort()->toNative());
        }

        $urlString = \sprintf('%s://%s%s%s%s%s%s', $this->getScheme(), $userPass, $this->getDomain(), $port, $this->getPath(), $this->getQueryString(), $this->getFragmentIdentifier());

        return $urlString;
    }
}
