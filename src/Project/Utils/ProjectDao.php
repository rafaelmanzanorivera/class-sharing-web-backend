<?php

namespace Project\Utils;

interface ProjectDAO
{
    public function fetchAll($sql, $params = null);
    public function fetch($sql, $params = null);
    public function execute($sql, $params = null);
    public function insert($sql, $params = null);
}
