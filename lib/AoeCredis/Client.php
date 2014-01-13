<?php

/**
 * Class AoeCredis_Client
 *
 * @author Fabrizio Branca
 * @since 2014-01-13
 */
class AoeCredis_Client extends Credis_Client {

    /**
     * @var int pid of the last process
     */
    protected $pid;

    /**
     * Overwriting the original connect method and close the connection if a changed pid was detected
     * (Due to forking)
     *
     * @return Credis_Client
     */
    public function connect() {

        $currentPid = getmypid();
        if (!is_null($this->pid) && $this->pid != $currentPid) {
            $this->close();
        }
        $this->pid = $currentPid;

        return parent::connect();
    }


}