<?php
/**
 * phpari - A PHP Class Library for interfacing with Asterisk(R) ARI
 * Copyright (C) 2014  Nir Simionovich
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 * Also add information on how to contact you by electronic and paper mail.
 *
 * Greenfield Technologies Ltd., hereby disclaims all copyright interest in
 * the library `phpari' (a library for creating smart telephony applications)
 * written by Nir Simionovich and its respective list of contributors.
 **/
class devicestates //extends phpari
{

    function __construct($connObject = null)
    {
        try {

            if (is_null($connObject) || is_null($connObject->ariEndpoint))
                throw new Exception("Missing PestObject or empty string", 503);

            $this->pestObject = $connObject->ariEndpoint;

        } catch (Exception $e) {
            die("Exception raised: " . $e->getMessage() . "\nFile: " . $e->getFile() . "\nLine: " . $e->getLine());
        }
    }


    /**
     *
     *
     * @return bool
     */
    public function devicestates_list()
    {
        try {

            if (is_null($this->pestObject))
                throw new Exception("PEST Object not provided or is null", 503);

            $uri = "/deviceStates";
            $result = $this->pestObject->get($uri);
            return $result;

        } catch (Exception $e) {
            $this->phpariObject->lasterror = $e->getMessage();
            $this->phpariObject->lasttrace = $e->getTraceAsString();
            return false;
        }
    }


    /**
     *
     * GET /deviceStates/{deviceName}
     * Retrieve the current state of a device.
     */
    public function devicestate_currentstate($deviceName = null)
    {
        try {

            if (is_null($this->pestObject))
                throw new Exception("PEST Object not provided or is null", 503);


            $uri = "/deviceStates/".$deviceName;
            $result = $this->pestObject->get($uri);

            return $result;

        } catch (Exception $e) {
            $this->phpariObject->lasterror = $e->getMessage();
            $this->phpariObject->lasttrace = $e->getTraceAsString();
            return false;
        }
    }

    /**
     *
     *  PUT /deviceStates/{deviceName}
     *  Change the state of a device controlled by ARI.
     *  (Note - implicitly creates the device state).
     *
     *
     * @param null $deviceName
     * @param null $deviceState
     * @return bool
     */
    public function devicestate_changestate($deviceName = null, $deviceState = null)
    {
        try {

            if (is_null($deviceName))
                throw new Exception("Device name is not provided or is null", 503);
            if (is_null($deviceState))
                throw new Exception("Device state name is  not provided or is null", 503);


            $putObj = array(
                'deviceState' =>$deviceState
            );

            $uri    = "/deviceStates/".$deviceName;
            $result = $this->pestObject->put($uri,$putObj);

            return $result;

        } catch (Exception $e) {
            $this->phpariObject->lasterror = $e->getMessage();
            $this->phpariObject->lasttrace = $e->getTraceAsString();
            return false;
        }
    }


    /**
     *  DELETE /deviceStates/{deviceName}
     *  Destroy a device-state controlled by ARI.
     *
     * @param null $deviceName
     * @return bool
     */
    public function devicestate_deletestate($deviceName = null)
    {
        try {

            if (is_null($deviceName))
                throw new Exception("Device name is not provided or is null", 503);

            $uri    = "/deviceStates/".$deviceName;
            $result = $this->pestObject->delete($uri);

            return $result;

        } catch (Exception $e) {
            $this->phpariObject->lasterror = $e->getMessage();
            $this->phpariObject->lasttrace = $e->getTraceAsString();
            return false;
        }
    }
}


