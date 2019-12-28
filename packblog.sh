#!/bin/bash

sed -i s/"'hostname'        => '127.0.0.1'"/"'hostname'        => 'b-okapcbi3tbctrc.bch.rds.bj.baidubce.com'"/ application/database.php
sed -i s/"'database'        => 'nk_blog'"/"'database'        => 'b_okapcbi3tbctrc'"/ application/database.php
sed -i s/"'username'        => 'root'"/"'username'        => 'b_okapcbi3tbctrc'"/ application/database.php
sed -i s/"'password'        => 'root'"/"'password'        => '7HwzA8LpI9fGBRqb'"/ application/database.php
sed -i s/"'app_debug'              => true"/"'app_debug'              => false"/ application/config.php
sed -i s/"'app_trace'              => true"/"'app_trace'              => false"/ application/config.php

tar -zcf nkblog.tar.gz .