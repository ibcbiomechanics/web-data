#!/bin/bash
# The following script will call init scripts so a new developer can easily
# start working on the project, as will be guided during his machine
# needed configuration to setup all the needed environment

if run-parts --exit-on-error ${0/.sh/}; then
	echo "================================================================"
	echo " CONGRATULATIONS, your environment is ready"
	echo "================================================================"
else
	echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!"
	echo " ERROR(s) detected, please check them and try again"
	echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!"
fi

