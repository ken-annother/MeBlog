#!/bin/bash

cd ./FinalBuild
FILE=`ls`
echo $1$FILE
curl $1$FILE