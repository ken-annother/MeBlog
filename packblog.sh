#!/bin/bash

sed -i s/"'hostname'        => '127.0.0.1'"/"'hostname'        => '$1.bch.rds.bj.baidubce.com'"/ application/database.php
sed -i s/"'database'        => 'nk_blog'"/"'database'        => '$1'"/ application/database.php
sed -i s/"'username'        => 'root'"/"'username'        => '$1'"/ application/database.php
sed -i s/"'password'        => 'root'"/"'password'        => '$2'"/ application/database.php
sed -i s/"'app_debug' => true"/"'app_debug' => false"/ application/config.php
sed -i s/"'app_trace' => true"/"'app_trace' => false"/ application/config.php

cat application/database.php
cat application/config.php

rm -rf .git
rm -rf .github

mkdir ../FinalBuild
tar -zcf ../FinalBuild/nkblog$(date "+%Y%m%d%H%M%S").tar.gz .
mv ../FinalBuild ./