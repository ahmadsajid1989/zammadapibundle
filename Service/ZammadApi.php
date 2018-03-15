<?php
/**
 * *************************************************************************
 *  Copyright (C) 2018 - 2018
 *
 *  This project is a extension of https://github.com/zammad/zammad-api-client-php
 *  Anyone is free to use or update.
 *
 * Developer Ahmad Sajid <ahmad@bongobd.com>
 *
 *  *************************************************************************
 */

/**
 * Created by PhpStorm.
 * User: Ahmad Sajid
 * Date: 3/15/2018
 * Time: 12:56 PM
 */

namespace ahmadsajid1989\ZammadApiBundle\Service;

use ZammadAPIClient\Client;
use ZammadAPIClient\ResourceType;

/**
 * Class ZammadApi
 * @package ahmadsajid1989\ZammadApiBundle\Service
 */
class ZammadApi
{
    /**
     * @var $client Client
     */
    protected $client;
    /**
     * @var $url
     */
    protected $url;

    /**
     * @var $username
     */
    protected $username;

    /**
     * @var $password
     */
    protected $password;

    /**
     * @var $debug
     */
    protected $debug;

    /**
     * @var $ticket
     */
    protected $ticket;

    /**
     * ZammadApi constructor.
     * @param $url
     * @param $username
     * @param $password
     * @param $debug
     */
    public function __construct($url, $username, $password, $debug)
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
        $this->debug = $debug;
    }

    /**
     * @return Client
     */
    protected function client(){

           $this->client = new Client([
                'url'      => $this->url,
                'username' => $this->username,
                'password' => $this->password,
                'debug'    => $this->debug
            ]);


        return $this->client;


    }

    /**
     * @param $id
     * @return $this|bool
     */
    public function getTicket($id){



        $ticket = $this->ticket = $this->client()->resource(ResourceType::TICKET)->get($id);

        if($this->ticket)

            return $this;

        if ($ticket->hasError() ) {

            return $ticket->getError();
        }

        return false;
    }



}